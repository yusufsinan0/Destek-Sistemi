const { db, mailTransporter } = require("../config/index"); 

function capitalizeFirstLetter(text) {
  return text.charAt(0).toUpperCase() + text.slice(1);
}

// Metindeki başındaki ve sonundaki boşlukları silen fonksiyon
function trimWhitespace(text) {
  return text.trim();
}

function capitalizeAndTrim(text) {
  // Baş harfi büyütüp boşlukları kırpan metni döndürme
  return text.trim().charAt(0).toUpperCase() + text.slice(1).trim();
}

// Email formatını kontrol eden fonksiyon
function validateEmail(email) {
    const emailRegex = /^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/;
    return emailRegex.test(email);
  }
  
  

function toMySQLDateTime(isoDateString) {
  const date = new Date(isoDateString);
  const mysqlDateTime = date.toISOString().slice(0, 19).replace('T', ' ');
  return mysqlDateTime;
}

function getPreviousMonthName() {
  const aylar = ["Ocak", "Şubat", "Mart", "Nisan", "Mayıs", "Haziran", "Temmuz", "Ağustos", "Eylül", "Ekim", "Kasım", "Aralık"];

  // Şu anki tarih
  const now = new Date();

  // Bir önceki ayın ay numarasını hesapla
  let previousMonth = now.getMonth() - 1;

  // Eğer ay Ocak ise (0), bir önceki ay Aralık (11) olur ve yılı da azaltmamız gerekir
  if (previousMonth < 0) {
    previousMonth = 11; // Aralık
  }

  // Bir önceki ayın ismini Türkçe olarak al
  const previousMonthName = aylar[previousMonth];

  return previousMonthName;
}









module.exports = {
  capitalizeFirstLetter,
  trimWhitespace,
  validateEmail,
  capitalizeAndTrim,
  getPreviousMonthName,
  toMySQLDateTime,
};