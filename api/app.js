const express = require('express');
const path = require('path');
const app = express();
const port = 8888;
const db = require('./config/index'); 
const Users = require('./routes/Users'); 
const Request = require('./routes/Request');
require('dotenv').config();

app.use(express.json());
app.use('/users', Users);
app.use('/request',Request);

app.set('views', path.join(__dirname, 'views'));
app.set('view engine', 'ejs');

// Public klasörünü statik dosyalar için ayarlayın
app.use(express.static(path.join(__dirname, 'views')));



app.listen(port, () => {
  console.log(`Server çalışmakta http://localhost:${port}`);
});
