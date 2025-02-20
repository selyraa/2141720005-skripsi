from flask import Flask, request, jsonify
from flask_cors import CORS
import numpy as np
import pickle
import os

app = Flask(__name__)
CORS(app)

model = None
scaler = None

try:
    with open('models/model.pkl', 'rb') as f:
        model = pickle.load(f)
    with open('models/scaler.pkl', 'rb') as f:
        scaler = pickle.load(f)
    print("Model and scaler loaded successfully!")
except Exception as e:
    print(f"Error loading model/scaler: {str(e)}")

@app.route('/predict', methods=['POST'])
def predict():
    try:
        data = request.get_json()
        
        features = {
            'Umur': float(data['age']),
            'Tinggi': float(data['height']),
            'Berat Badan': float(data['weight']),
            'Lemak Tubuh': float(data['bodyFat']),
            'Lemak Perut': float(data['bellyFat']),
            'Kepadatan Tulang': float(data.get('boneDensity')),
            'Kebutuhan Kalori': float(data['calorieNeeds']),
            'Usia Sel': float(data.get('cellAge')),
            'Massa Otot': float(data['muscleMass']),
            'Kadar air': float(data.get('waterContent'))
        }

        input_data = np.array([[
            features['Umur'],
            features['Tinggi'], 
            features['Berat Badan'],
            features['Lemak Tubuh'],
            features['Lemak Perut'],
            features['Kepadatan Tulang'],
            features['Kebutuhan Kalori'],
            features['Usia Sel'],
            features['Massa Otot'],
            features['Kadar air']
        ]])

        if scaler is not None:
            input_scaled = scaler.transform(input_data)
        else:
            input_scaled = input_data

        if model is not None:
            prediction = model.predict(input_scaled)
            probabilities = model.predict_proba(input_scaled)[0]
            
            program_map = {
                0: "Turun BB",
                1: "Turun Lemak",
                2: "Naik BB"
            }
            
            result = {
                "prediction": program_map[prediction[0]],
                "probabilities": {
                    "Turun BB": float(probabilities[0]),
                    "Turun Lemak": float(probabilities[1]),
                    "Naik BB": float(probabilities[2])
                }
            }
            
            return jsonify({
                "status": "success",
                "result": result
            })
        else:
            return jsonify({
                "status": "error",
                "message": "Model not loaded"
            }), 500

    except Exception as e:
        return jsonify({
            "status": "error",
            "message": str(e)
        }), 400

if __name__ == '__main__':
    app.run(debug=True, port=5000)
