const { promisify } = require('util');
const jwt = require('jsonwebtoken');
const  db  = require("../config/index");
require('dotenv').config({ path: '.env' });

function authenticateAdminToken(req, res, next) {
    const authHeader = req.headers.authorization;
    const token = authHeader && authHeader.split(' ')[1];

    

    if (!token) {
        return res.status(401).send({ error: "Authentication failed, token required" });
    }

    promisify(jwt.verify)(token, process.env.SECRET_KEY).then(decoded => {
        const userId = decoded.userID;

        db.query('SELECT * FROM Users WHERE User_ID = ?', [userId], (error, results) => {
            if (error) {
                console.error("Database error:", error);
                return res.status(500).send({ error: "Database error" });
            }
            if (results.length === 0) {
                return res.status(404).send({ error: "User not found1" });
            }
            req.user = results[0];
            next();
        });
    }).catch(err => {
        console.error("Token verification failed:", err);
        return res.status(403).send({ error: "Verification failed, invalid token" });
    });
}

function authorizeCron() {
    return function(req, res, next) {
        const { token } = req.body;

        if (token == undefined) {
            return res.status(401).send({ error: "Authentication failed, token required" })
        }

        if (token == "zkLctNgP67VJJZhSpnfnLbGdwlaOT7M0EY3Z6CvTbOFFdyfGpS3AmZ0S5S6uDLtDNXAGVL9QPXFlGtXagLwNCG1rD9R4ER1h") {
            next();
        } else {
            return res.status(403).send({ error: "Verification failed, invalid token" });
        }
    };
    
}

function authorize(permissions) {
    return function(req, res, next) {
        const authHeader = req.headers['authorization'];
        const token = authHeader && authHeader.split(' ')[1];  // Bearer token'ı al

        if (!token) {
            return res.status(401).send({ message: "No token provided" });
        }

        try {
            const decoded = jwt.verify(token, process.env.SECRET_KEY);
            const userPermission = decoded.userPermission;

            if (Array.isArray(permissions)) {
                if (permissions.includes(userPermission)) {
                    next();
                } else {
                    return res.status(403).json({ error: "Unauthorized, access denied" });
                }
            } else {
                if (decoded.userPermission == permissions) {
                    next();
                } else {
                    return res.status(403).json({ error: "Unauthorized, access denied" });
                }
            }
        } catch {
            return res.status(401).json({ error: "Invalid token." });
        }
    };
}





module.exports = {
    authenticateAdminToken,
    authorize,
    authorizeCron
};