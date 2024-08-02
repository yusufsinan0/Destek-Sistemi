const mysql = require('mysql2');

const pool = mysql.createPool({
    connectionLimit: 100,
    host: "212.58.20.68",
	port:3306,
    user: "destekUser",
    password: "Destek2024**",
    database: "destekUser",
});

function handleDisconnect() {
    pool.getConnection((err, connection) => {
        if (err) {
            console.error('error when connecting to db:', err);
            setTimeout(handleDisconnect, 2000);
        } else {
            console.log('Connected to the database.');
            connection.release();
        }
    });

    pool.on('error', function(err) {
        console.error('db error', err);
        if (err.code === 'PROTOCOL_CONNECTION_LOST') {
            handleDisconnect();
        } else {
            throw err;
        }
    });
}

handleDisconnect();

module.exports = pool
