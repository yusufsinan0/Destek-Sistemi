const jwt = require('jsonwebtoken')
require('dotenv').config({path : 'env'})

function checkAuthToken(req){
    const authHeader = req.headers['authorization']
    const token = authHeader && authHeader.split(' ')[1]

    return token || null
}

function checkPermissions(token){
    try {
        const decoded = jwt.verify(token , process.env.SECRET_KEY)
        const userTypeID = decoded.userTypeID
        console.log(userTypeID)

        if(userTypeID == 1 ){
            return true
        } else {
            return false
        }

    } catch (error){
        console.error('İzin hatası ' , error)
        return false
    }
}
module.exports = {
    checkAuthToken,
    checkPermissions
}



