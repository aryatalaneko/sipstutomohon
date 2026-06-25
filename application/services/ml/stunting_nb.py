import sys
import json
import pandas as pd
import mysql.connector
from sklearn.model_selection import train_test_split
from sklearn.naive_bayes import GaussianNB
from sklearn.metrics import accuracy_score, precision_recall_fscore_support, confusion_matrix
import numpy as np

def run_ml():
    try:
        # 1. Database Connection
        db = mysql.connector.connect(
            host="localhost",
            user="root",
            password="",
            database="sipstu_db"
        )
        
        # 2. Fetch Data
        query = """
            SELECT 
                balita.tgl_lahir, 
                balita.jenis_kelamin, 
                pb.tgl_pengukuran, 
                pb.berat_badan, 
                pb.tinggi_badan, 
                pb.status_stunting
            FROM pengukuran_balita pb
            JOIN balita ON balita.id = pb.balita_id
            WHERE pb.status_stunting IS NOT NULL AND pb.status_stunting != ''
        """
        df = pd.read_sql(query, db)
        db.close()

        if df.empty or len(df) < 5:
            return {"error": "Insufficent data for training (min 5 records required)."}

        # 3. Preprocessing
        # - Calculate Age in Months
        df['tgl_lahir'] = pd.to_datetime(df['tgl_lahir'])
        df['tgl_pengukuran'] = pd.to_datetime(df['tgl_pengukuran'])
        df['usia_bulan'] = ((df['tgl_pengukuran'] - df['tgl_lahir']).dt.days / 30.44).round().astype(int)
        
        # - Encode Gender (L: 1, P: 0)
        df['jk_encoded'] = df['jenis_kelamin'].apply(lambda x: 1 if x == 'L' else 0)
        
        # - Features and Target
        X = df[['usia_bulan', 'jk_encoded', 'berat_badan', 'tinggi_badan']]
        y = df['status_stunting']

        # 4. Train/Test Split
        X_train, X_test, y_train, y_test = train_test_split(X, y, test_size=0.2, random_state=42)

        # 5. Model Training (Naive Bayes)
        model = GaussianNB()
        model.fit(X_train, y_train)

        # 6. Prediction & Evaluation
        y_pred = model.predict(X_test)
        
        # - Metrics
        acc = accuracy_score(y_test, y_pred)
        # Use macro average as requested for overall evaluation
        precision, recall, f1, _ = precision_recall_fscore_support(y_test, y_pred, average='macro', zero_division=0)
        
        # - Per category details
        labels = model.classes_.tolist()
        p_cat, r_cat, f_cat, _ = precision_recall_fscore_support(y_test, y_pred, labels=labels, zero_division=0)
        category_metrics = {}
        for idx, label in enumerate(labels):
            category_metrics[label] = {
                "precision": round(p_cat[idx], 4),
                "recall": round(r_cat[idx], 4),
                "f1": round(f_cat[idx], 4)
            }

        # 7. Sample Predictions (Recent 5 from whole dataset)
        sample_df = df.tail(5).copy()
        X_sample = sample_df[['usia_bulan', 'jk_encoded', 'berat_badan', 'tinggi_badan']]
        sample_df['prediction'] = model.predict(X_sample)
        
        samples = []
        for idx, row in sample_df.iterrows():
            samples.append({
                "aktual": row['status_stunting'],
                "prediksi": row['prediction'],
                "fitur": f"Usia: {row['usia_bulan']}bln, BB: {row['berat_badan']}kg, TB: {row['tinggi_badan']}cm"
            })

        # Final JSON Output
        result = {
            "status": "success",
            "metrics": {
                "accuracy": round(acc, 4),
                "precision": round(precision, 4),
                "recall": round(recall, 4),
                "f1_score": round(f1, 4)
            },
            "category_details": category_metrics,
            "samples": samples,
            "total_data": len(df),
            "train_size": len(X_train),
            "test_size": len(X_test)
        }
        return result

    except Exception as e:
        return {"error": str(e)}

if __name__ == "__main__":
    output = run_ml()
    print(json.dumps(output))
