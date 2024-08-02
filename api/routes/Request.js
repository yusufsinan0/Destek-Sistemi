const express = require('express');
const router = express.Router();
const { validateEmail } = require('../helpers/Functions');
const {SelectQuery, InsertQuery,UpdateQuery} = require('../helpers/SqlServices')
const jwt = require('jsonwebtoken');

const {authenticateAdminToken} = require('../middleware/index');
const {checkPermissions , checkAuthToken} = require('../middleware/Check');
const { error } = require('console');
const db = require('../config/index')


router.get('/',(req,res)=>{
    res.status(200).send({ message: "Request route çalışmakta" });

});

router.post('/add',authenticateAdminToken,(req,res)=>{
    const {requestPriority,requestTitle,requestDescription} = req.body
  
    const token = checkAuthToken(req)
    if(!token){
        res.status(401).send({message : "Token değeriniz boş"})
    } 

        const decoded = jwt.verify(token,process.env.SECRET_KEY)
    
        const requestData = {
            Request_User_ID :  decoded.userID ,
            Request_Title : requestTitle,
            Request_Firstname :decoded.userFirstname,
            Request_Lastname : decoded.userLastname,
            Request_Email : decoded.userEmail,
            Request_Phone : decoded.userPhone,
            Request_Description : requestDescription,
            Request_Priority_ID : requestPriority,
            Request_Status_ID : 1
        }
        
        InsertQuery("Request",requestData,(error,results)=>{
            if(error){
                return res.status(500).send({message : "Veritabanında hata oluştu", error:error.message})
            } else {
                return res.status(200).send({message : "Talebiniz başarıyla oluşturuldu" , status : 'success'})
            }
        })
    
})


// sadece ilgili kullanıcının açmış olduğu taleplerin listelendiği endpoint
router.post('/customer', authenticateAdminToken, (req, res) => {
    const { userID } = req.body;  
    const token = checkAuthToken(req);
    
    if (!token) {
        return res.status(500).send({ message: "Token değeri boş" });
    }

    try {
        const decoded = jwt.verify(token, process.env.SECRET_KEY);

        if (!userID) {
            return res.status(400).send({ message: "userID is required" });
        }

        const sql = `
            SELECT * 
            FROM Request 
            LEFT JOIN Request_Status ON Request.Request_Status_ID = Request_Status.Status_ID 
            LEFT JOIN Request_Priority ON Request.Request_Priority_ID = Request_Priority.Priority_ID
            WHERE Request.Request_User_ID = ?
        `;

        db.query(sql, [userID], (error, results) => {
            if (error) {
                res.status(500).send({ message: "Veritabanı hatası", error: error.message });
            } else {
                res.status(200).send({ message: results, status: 'success' });
            }
        });

    } catch (err) {
        res.status(401).send({ message: "Token doğrulama hatası" });
    }
});


router.post('/admin',authenticateAdminToken,(req,res)=>{
    const token = checkAuthToken(req)
    if(!token){
        return res.status(500).send({ message: "Token değeri boş" });
    }

    const sql = 'SELECT * FROM Request LEFT JOIN Request_Status ON Request.Request_Status_ID = Request_Status.Status_ID LEFT JOIN Request_Priority ON Request.Request_Priority_ID = Request_Priority.Priority_ID';

    db.query(sql,"",(error,results)=>{
        if(error){
            return res.status(500).send({message : "Veritabanı hatası",error:error.message})
        } else {
            return res.status(200).send({message : results , status : 'success'})
        }
    })
})

router.post('/admin/update',authenticateAdminToken,(req,res)=>{
    const {requestID,requestDescriptionReply,requestStatus,requestClosedID} = req.body
        
    const token = checkAuthToken(req)
    if(!token){
        return res.status(500).send({ message: "Token değeri boş" });
    }

    const updateData= {
        Request_Description_Reply : requestDescriptionReply,
        Request_Status_ID : requestStatus,
        Request_Closed_ID : requestClosedID
    }

    const whereClause = {
        Request_ID : requestID,
    }

    UpdateQuery("Request",updateData,whereClause,(error,results)=>{
        if(error){
            return res.status(500).send({message : "Veritabanı hatası"})
        } else {
            return res.status(200).send({message : results,status : 'success'})
        }
    })
})

router.post('/admin/status',authenticateAdminToken,(req,res)=>{
    const {requestID , statusID} = req.body

    const token = checkAuthToken(req)
    if(!token){
        return res.status(500).send({ message: "Token değeri boş" });
    }

    const updateData= {
        Request_Status_ID : statusID
    }

    const whereClause = {
        Request_ID : requestID,
    }

    UpdateQuery("Request",updateData,whereClause,(error,results)=>{
        if(error){
            return res.status(500).send({message : "Veritabanı hatası"})
        } else {
            return res.status(200).send({message : results,status : 'success'})
        }
    })


})

router.post('/id',authenticateAdminToken,(req,res)=>{
    const {requestID} = req.body
    const token = checkAuthToken(req)
    if(!token){
        return res.status(500).send({message : "Token değeri boş"})
    }

    const whereClause = {
        Request_ID : requestID
    }

    SelectQuery("Request",whereClause,(error,results)=>{
        if(error){
            return res.status(500).send({error : "Veritabanı hatası"})

        } else {
            return res.status(200).send({message : results , status : 'success'})
        }
    })

})

router.get('/count-request',authenticateAdminToken,(req,res)=>{
    const token = checkAuthToken(req)
    if(!token){
        return res.status(500).send({message : "Token değeri boş"})
    } else {

        const sql = 'SELECT COUNT(*) as total FROM Request'
        db.query(sql,"",(error,results)=>{
            if(error){
                return res.status(500).send({error : "Veritabanı hatası"})

            } else {
                return res.status(200).send({message : results , status : 'success'})

            }
        })
    }
})

router.get('/count-id',authenticateAdminToken,(req,res)=>{
    const {userID} = req.body
    const token = checkAuthToken(req)
    if(!token){
        return res.status(500).send({message : "Token değeri boş"})
    } else {
       
        const whereClause ={
            User_ID : userID
        }

        const sql = `SELECT COUNT(*) as total FROM Request WHERE ${whereClause}` 
        db.query(sql,(error,results)=>{
            if(error){
                return res.status(500).send({error : "Veritabanı hatası"})

            } else {
                return res.status(200).send({message : results , status : 'success'})

            }
        })
    }
})

router.get('/closed-request',authenticateAdminToken,(req,res)=>{
    const token = checkAuthToken(req)
    if(!token){
        return res.status(500).send({message : "Token değeri boş"})
       
    } else {
        const decoded = jwt.verify(token,process.env.SECRET_KEY)

        const whereClause = {
            Request_Closed_ID : decoded.userID
        }
        SelectQuery("Request",whereClause,(error,results)=>{
            if(error){
                return res.status(500).send({error : "Veritabanı hatası"})

            } else {
                const rowCount = results.length
                return res.status(200).send({
                    message : {rowCount : rowCount} ,
                    status : 'success'})
            }
        })
        
     } 
})


module.exports = router;