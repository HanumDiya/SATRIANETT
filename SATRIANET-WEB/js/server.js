// server.js
const express = require('express');
const bodyParser = require('body-parser');
const mysql = require('mysql2');
const path = require('path');

const app = express();
const port = 3000;

// Konfigurasi koneksi database
const db = mysql.createConnection({
    host: 'localhost',
    user: 'root', // Ganti dengan username database Anda
    password: '', // Ganti dengan password database Anda
    database: 'your_database_name' // Ganti dengan nama database Anda
});

db.connect(err => {
    if (err) {
        throw err;
    }
    console.log('Connected to database.');
});

// Middleware
app.use(bodyParser.json());
app.use(bodyParser.urlencoded({ extended: true }));
app.use(express.static(path.join(__dirname, 'public'))); // Menyajikan file statis dari folder 'public'

// Endpoint login
app.post('/login', (req, res) => {
    const { username, password } = req.body;

    const query = 'SELECT * FROM users WHERE username = ? AND password = ?';
    db.execute(query, [username, password], (err, results) => {
        if (err) {
            return res.status(500).json({ error: 'Database query error' });
        }
        if (results.length > 0) {
            res.status(200).json({ success: 'Login successful' });
        } else {
            res.status(401).json({ error: 'Invalid username or password' });
        }
    });
});

// Start server
app.listen(port, () => {
    console.log(`Server is running on http://localhost:${port}`);
});
