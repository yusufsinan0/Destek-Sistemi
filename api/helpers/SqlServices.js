const db = require('../config/index');
const bcrypt = require('bcrypt');



//Insert komutlarınn işlemlerinin başlatıldığı fonksiyon başlangıcı

function InsertQuery(tableName,data,callback){
    
    const columns = Object.keys(data).join(', ')
    const values  = Object.values(data) 

    const sql = `INSERT INTO ${tableName} (${columns}) VALUES (${values.map(()=>'?').join(', ') })`


   executeQuery(sql,values,callback)
    
}

//Select komutlarının başlatıldığı fonksiyon başlangıcı

function SelectQuery(tableName, whereClause, callback) {
    let sql = `SELECT * FROM ${tableName}`;
    let values = [];

    if (Object.keys(whereClause).length > 0) {
        const whereKeys = Object.keys(whereClause);
        const whereValues = Object.values(whereClause);
        sql += ` WHERE ` + whereKeys.map(key => `${key} = ?`).join(' AND ');
        values = whereValues;
    }
    console.log(sql)

    executeQuery(sql, values, callback);
}

function UpdateQuery(tableName, updateData, whereClause, callback) {
    let sql = `UPDATE ${tableName} SET `;
    let values = [];

    // Update kısmını oluştur
    const updateKeys = Object.keys(updateData);
    const updateValues = Object.values(updateData);
    sql += updateKeys.map(key => `${key} = ?`).join(', ');
    values = [...updateValues];

    if (Object.keys(whereClause).length > 0) {
        const whereKeys = Object.keys(whereClause);
        const whereValues = Object.values(whereClause);
        sql += ` WHERE ` + whereKeys.map(key => `${key} = ?`).join(' AND ');
        values = [...values, ...whereValues];
    }



    executeQuery(sql, values, callback);
}

function DeleteQuery(tableName, data, callback) {
    const whereClause = Object.keys(data).map(key => `${key} = ?`).join(' AND ');
    const values = Object.values(data);

    const sql = `DELETE FROM ${tableName} WHERE ${whereClause}`;

    executeQuery(sql, values, callback);
}



function executeQuery(sql, values, callback) {
    db.query(sql, values, (error, results) => {
        if (error) {
            console.error('Database query error:', error); // Hata ayıklama
            callback(error, null);
        } else {
            callback(null, results);
        }
    });
}


module.exports = {
    InsertQuery,
    SelectQuery,
    UpdateQuery,
    DeleteQuery
  
};