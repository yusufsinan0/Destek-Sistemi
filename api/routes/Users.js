const express = require('express');
const router = express.Router();
const { validateEmail } = require('../helpers/Functions');
const {SelectQuery, InsertQuery,DeleteQuery} = require('../helpers/SqlServices')
const bcrypt = require('bcrypt');
const jwt = require('jsonwebtoken');
const { authenticateAdminToken } = require('../middleware');
const {checkPermissions , checkAuthToken} = require('../middleware/Check')



router.get('/', (req, res) => {
  res.status(200).send({ message: "Users route çalışmakta" });
});


//Kullanıcı kayıt olma işlemlerine başladığım endpoint
router.post('/register', (req, res) => {
  const { userFirstname, userLastname, userEmail, userPhone, userPassword, userTypeID , userGenderID} = req.body;

  if (!userFirstname || !userLastname || !userEmail || !userPhone || !userPassword || !userTypeID || !userGenderID) {
    return res.status(400).send({ message: "Lütfen tüm alanları doldurduğunuzdan emin olun." });
  }

  if (validateEmail(userEmail)) {
    const hashedPassword = bcrypt.hashSync(userPassword, 10);
    const UserData = {
      User_Firstname: userFirstname,
      User_Lastname: userLastname,
      User_Email: userEmail,
      User_Phone: userPhone,
      User_Password: hashedPassword,
      User_Type_ID : userTypeID,
      User_Gender_ID : userGenderID
    };

    InsertQuery("Users", UserData, (error, results) => {
      if (error) {
        return res.status(500).send({ message: "Veritabanı Hatası", error: error.message });
      } else {
        return res.status(200).send({message : "Başarılı bir şekilde giriş yaptınız"})
      }
    });
  } else {
    return res.status(400).send({ message: "Geçersiz e-posta adresi" });
  }
});



router.post('/login', (req, res) => {
    const { userEmail, userPassword } = req.body;

    if (!userEmail || !userPassword) {
        return res.status(500).send({ message: "Email veya parola boş!" });
    }

    if (validateEmail(userEmail)) {
        const whereClause = { User_Email: userEmail };

        SelectQuery('Users', whereClause, (error, results) => {
            if (error) {
                return res.status(500).send({ message: "Veritabanı hatası", error: error.message });
            } else {
                if (results.length > 0) {
                    const user = results[0];
                    if (!bcrypt.compareSync(userPassword, user.User_Password)) {
                        return res.status(500).send({ message: "Şifre Yanlış" });
                    }

                    const token = jwt.sign({
                        userID: user.User_ID,
                        userFirstname: user.User_Firstname,
                        userLastname: user.User_Lastname,
                        userPhone: user.User_Phone,
                        userEmail : user.User_Email,
                        userTypeID: user.User_Type_ID
                    }, process.env.SECRET_KEY, { expiresIn: '30D' });

                    return res.status(200).send({
                        status : 'success',
                        message: "Başarılı bir şekilde giriş yaptınız",
                        token: token,
                        userFirstname : user.User_Firstname,
                        userLastname : user.User_Lastname,
                        userTypeID : user.User_Type_ID });
                } else {
                    return res.status(500).send({status : 'error', message: "Girdiğiniz e-posta veya şifre yanlış" });
                }
            }
        });
    } else {
        return res.status(500).send({ message: "Geçersiz e-posta adresi!" });
    }
});


// Kullanıcıya ait olan profil bilgilerinin gösterildiği endpoint

router.get('/me',authenticateAdminToken,(req,res)=>{

  const token = checkAuthToken(req)
  
  const decoded = jwt.verify(token,process.env.SECRET_KEY)
  const userID = decoded.userID

  const whereClause = {
    User_ID : userID
  }


  if(!token){
    return res.status(500).send({message : "Token değeri boş"})
  } else {
    SelectQuery("Users",whereClause ,(error,results)=>{
      if(error){
        return res.status(500).send({message : "Veritabanı hatası",error : error.message})
      } else {
        const user = results[0] || {};
        return res.status(200).send({message : user})

      }
    })

  }

})



router.get('/count',authenticateAdminToken,(req,res)=>{
  const token = checkAuthToken(req)
  if(!token){
      return res.status(500).send({message : "Token değeri boş"})
  } else {

      const sql = 'SELECT COUNT(*) as total FROM Users'
      db.query(sql,"",(error,results)=>{
          if(error){
              return res.status(500).send({error : "Veritabanı hatası"})

          } else {
              return res.status(200).send({message : results , status : 'success'})

          }
      })
  }
})

router.get('/all',authenticateAdminToken,(req,res)=>{
  const token = checkAuthToken(req)
  if(!token){
    return res.status(500).send({message : "Token değeri boş"})
  } else {
    SelectQuery("Users","",(error,results)=>{
      if(error){
        return res.status(500).send({error : "Veritabanı hatası"})

      } else {
        return res.status(200).send({message : results , status : 'success'})

      }
    })
  }
})

router.post('/delete',authenticateAdminToken,(req,res)=>{
  const userID =  req.body.userID;
    const token = checkAuthToken(req)



  if(!userID || !token){
    return res.status(500).send({message :"Token değeri bulunamadı"})
  } else {
    whereClause = {
      User_ID : userID
    }
    DeleteQuery("Users",whereClause,(error,results)=>{
      if(error){
        return res.status(500).send({message : "İlgili kullanıcı silinemedi", error : error.message})
      } else {
        return res.status(200).send({message : "Kullanıcı başarıyla silindi",status : 'success'})
      }
    })

  }
})



module.exports = router;
