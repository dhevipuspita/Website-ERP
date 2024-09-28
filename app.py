from flask import Flask, jsonify, request
import mysql.connector
from mysql.connector import Error

app = Flask(__name__)

# Function to create a database connection
def create_connection():
    try:
        connection = mysql.connector.connect(
            host='localhost',
            database='fp_pemasaran',
            user='root',
            password=''
        )
        return connection
    except Error as e:
        print(f"Database connection error: '{e}'")
        return None

# Endpoint to get all marketing data
@app.route('/api/pemasaran', methods=['GET'])
def get_pemasaran():
    connection = create_connection()
    if connection is None:
        return jsonify({"message": "Database connection failed"}), 500

    try:
        cursor = connection.cursor(dictionary=True)
        cursor.execute("SELECT * FROM pemasaran")
        data = cursor.fetchall()
        cursor.close()
        connection.close()
        return jsonify(data)
    except Error as e:
        print(f"Error retrieving data: '{e}'")
        return jsonify({"message": "Error retrieving data"}), 500

# Endpoint to get marketing data by ID
@app.route('/api/pemasaran/<int:id_pemasaran>', methods=['GET'])
def get_pemasaran_by_id(id_pemasaran):
    connection = create_connection()
    if connection is None:
        return jsonify({"message": "Database connection failed"}), 500

    try:
        cursor = connection.cursor(dictionary=True)
        cursor.execute("SELECT * FROM pemasaran WHERE id_pemasaran = %s", (id_pemasaran,))
        pemasaran = cursor.fetchone()
        cursor.close()
        connection.close()
        if pemasaran:
            return jsonify(pemasaran)
        return jsonify({"message": "Data not found"}), 404
    except Error as e:
        print(f"Error retrieving data: '{e}'")
        return jsonify({"message": "Error retrieving data"}), 500

# Endpoint to add new marketing data
@app.route('/api/pemasaran', methods=['POST'])
def add_pemasaran():
    new_data = request.get_json()
    connection = create_connection()
    if connection is None:
        return jsonify({"message": "Database connection failed"}), 500

    try:
        cursor = connection.cursor()
        cursor.execute(
            "INSERT INTO pemasaran (tanggal, jenis_pemasaran, target_pemasaran, hasil_pemasaran, durasi_pemasaran) VALUES (%s, %s, %s, %s, %s)",
            (new_data['tanggal'], new_data['jenis_pemasaran'], new_data['target_pemasaran'], new_data['hasil_pemasaran'], new_data['durasi_pemasaran'])
        )
        connection.commit()
        cursor.close()
        connection.close()
        return jsonify(new_data), 201
    except Error as e:
        print(f"Error adding data: '{e}'")
        return jsonify({"message": "Error adding data"}), 500

# Endpoint to update marketing data by ID
@app.route('/api/pemasaran/<int:id_pemasaran>', methods=['PUT'])
def update_pemasaran(id_pemasaran):
    updated_data = request.get_json()
    connection = create_connection()
    if connection is None:
        return jsonify({"message": "Database connection failed"}), 500

    try:
        cursor = connection.cursor()
        cursor.execute(
            "UPDATE pemasaran SET tanggal = %s, jenis_pemasaran = %s, target_pemasaran = %s, hasil_pemasaran = %s, durasi_pemasaran = %s WHERE id_pemasaran = %s",
            (updated_data['tanggal'], updated_data['jenis_pemasaran'], updated_data['target_pemasaran'], updated_data['hasil_pemasaran'], updated_data['durasi_pemasaran'], id_pemasaran)
        )
        connection.commit()
        cursor.close()
        connection.close()
        return jsonify(updated_data)
    except Error as e:
        print(f"Error updating data: '{e}'")
        return jsonify({"message": "Error updating data"}), 500

# Endpoint to delete marketing data by ID
@app.route('/api/pemasaran/<int:id_pemasaran>', methods=['DELETE'])
def delete_pemasaran(id_pemasaran):
    connection = create_connection()
    if connection is None:
        return jsonify({"message": "Database connection failed"}), 500

    try:
        cursor = connection.cursor()
        cursor.execute("DELETE FROM pemasaran WHERE id_pemasaran = %s", (id_pemasaran,))
        connection.commit()
        cursor.close()
        connection.close()
        return jsonify({"message": "Data deleted"})
    except Error as e:
        print(f"Error deleting data: '{e}'")
        return jsonify({"message": "Error deleting data"}), 500

if __name__ == '__main__':
    app.run(debug=True, host='0.0.0.0', port=5000)
