# Deteksi Program

A Flask-based API for detecting and recommending fitness programs based on user physical metrics.

## Setup Instructions

1. Clone the repository:
```bash
git clone https://github.com/yourusername/deteksi-program.git
cd deteksi-program
```

2. Create and activate a virtual environment (recommended):
```bash
python -m venv venv
source venv/bin/activate  # On Windows use: venv\Scripts\activate
```

3. Install dependencies:
```bash
pip install -r requirements.txt
```

4. Make sure you have the required model files:
- `model.pkl`
- `scaler.pkl`

5. Run the application:
```bash
python app.py
```

The server will start at `http://localhost:5000`

## API Documentation

### Predict Program Endpoint

**POST** `/predict`

Request body (JSON):
```json
{
    "age": 25,
    "height": 170,
    "weight": 65,
    "bodyFat": 20,
    "bellyFat": 15,
    "boneDensity": 2.4,
    "calorieNeeds": 2000,
    "cellAge": 40,
    "muscleMass": 30,
    "waterContent": 46.7
}
```

Response format:
```json
{
    "status": "success",
    "result": {
        "prediction": "Turun BB",
        "probabilities": {
            "Turun BB": 0.7,
            "Turun Lemak": 0.2,
            "Naik BB": 0.1
        }
    }
}
```

## Error Handling

The API will return appropriate error messages with 400 or 500 status codes if:
- Required data is missing
- Input values are invalid
- Server encounters an error
- Model is not properly loaded