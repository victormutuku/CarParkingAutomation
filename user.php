<?php
    include_once 'account.php';
    session_start();

    class User implements Account{
        //Login & Register
        private $fullName;
        private $user_token;
        private $UserPassword;
        private $inputPass;
        //User Details and Car Details
        private $userType;
        private $numberplate;
        private $car_colour;
        private $car_type;
        private $phoneNo;
        private $carid;
        private $timestamp;
        //Session Details
        private $session;
        private $sessionID;
        private $userId;
        private $userName;


        public function __construct(){ 
            $this->fullName = "";
            $this->user_token = "";  
            $this->UserPassword = "";  
            $this->inputPass = "";          
        }

        //getters and setter
        public function setFullName($fn){
            $this->fullName = $fn;
        }

        public function getFullName(){
            return $this->fullName;
        }

        public function setuser_token($em){
            $this->user_token = $em;
        }

        public function getuser_token(){
            return $this->user_token;
        }

        public function setinputPass($pass){
            $this->inputPass = $pass;
        }

        public function getinputPass(){
            return $this->inputPass;
        }
       
        public function setUserType($UserType){
            $this->userType = $UserType;
        }

        public function getUserType(){
            return $this->userType;
        }

        public function setNumberPlate($numberPlate){
            $this->numberplate = $numberPlate;
        }

        public function getNumberPlate(){
            return $this->numberplate;
        }

        public function setCarColour($carcolor){
            $this->car_colour = $carcolor;
        }

        public function getCarColour(){
            return $this->car_colour;
        }

        public function setCarType($CarType){
            $this->car_type = $CarType;
        }

        public function getCarType(){
            return $this->car_type;
        }

        public function setPhoneNo($PhoneNo){
            $this->phoneNo = $PhoneNo;
        }

        public function getPhoneno(){
            return $this->phoneNo;
        }

        public function setSession($session)
        {
            $this->session = $session;
            return $this;
        }
 
        public function getSession()
        {
            return $this->session;
        }

        public function setSessionID($sessionID)
        {
            $this->sessionID = $sessionID;
            return $this;
        }

        public function getSessionID()
        {
            return $this->sessionID;
        }
        
        public function setUserId($userId)
        {
            $this->userId = $userId;
            return $this;
        }
 
        public function getUserId()
        {
            return $this->userId;
        }
 
        public function setUserName($userName)
        {
            $this->userName = $userName;
            return $this;
        }

        public function getUserName()
        {
            return $this->userName;
        }

        public function register ($pdo) {
            try{
                //prepare a query
                $stm = $pdo->prepare("INSERT INTO user (UserName, UserToken, UserPassword ) VALUES(?,?,?)");
                $stm->execute([$this->fullName,$this->user_token,$this->inputPass]);
                $stm = null;
                return "Registration was successful";
                echo "hello it is working";
            }catch (PDOException $ex){
                return $ex->getMessage();
                //in production return a generic message, but log the specific
            }
            //factor out the profile picture. 
        }
        public function login($pdo) {
            try {
                $stmt = $pdo->prepare("SELECT UserPassword FROM user WHERE UserToken = ?");
                $stmt->execute([$this->user_token]);
                $result = $stmt->fetch();
                $this->UserPassword = $result['UserPassword'];
                
                if (Password_verify($this->inputPass, $this->UserPassword)) {


                    $stmt = $pdo->prepare("SELECT * FROM user WHERE UserToken = ? AND UserPassword = ?");
                    $stmt->execute([$this->user_token, $this->UserPassword]);
                    $result = $stmt->fetch();
                    $this->userId = $result['UserID'];
                    $this->userName = $result['UserName'];
                    $this->userType = $result['Type'];

                    if($this->userType == "Admin"){
                        $_SESSION['User'] = $this->userName;
                        $this->sessionID = session_id();
                        $stm = $pdo->prepare("INSERT INTO user_sessions(User_ID, UserName, User_Type, Session_ID) VALUES(?,?,?,?)");
                        $stm->execute([$this->userId,$this->userName,$this->userType, $this->sessionID]);
                        $stm = null;
                        header("Location: admin/admin.php");
                        
                    }else if($this->userType == "Master"){
                        $_SESSION['User'] = $this->userName;
                        $this->sessionID = session_id();
                        $stm = $pdo->prepare("INSERT INTO user_sessions(User_ID, UserName, User_Type, Session_ID) VALUES(?,?,?,?)");
                        $stm->execute([$this->userId,$this->userName,$this->userType, $this->sessionID]);
                        $stm = null;
                        header("Location: employee.php");
                    }else{
                        header("Location: index.php");
                    }
                    
                    $stmt = null;
                    return $result;
                                    
                } else {
                    header("Location: index.php?login=credentials");
                }
            } catch (PDOException $e) {
                return $e->getMessage();
            }
        }

        public function carReg($pdo){
            $stmt = $pdo->prepare("INSERT INTO car (CarPlate, CarType, CarColour, Phone_Number) VALUES(?,?,?,?)");
            $stmt->execute([$this->numberplate,$this->car_type,$this->car_colour,$this->phoneNo]);
            $stmt = null;
            header("Location: employee.php"); 
        }

        public function carcheckout($pdo){
            $_SESSION['checkout'] = $this->numberplate;
            $st = $pdo->prepare("SELECT time_in FROM car WHERE CarPlate = ?");
            $st->execute([$this->numberplate]);
            $result = $st->fetch();
            $this->timestamp = $result['time_in'];    
        }
        public function carDetails($pdo){
            $stmt = $pdo->prepare("SELECT * FROM car");
            $stmt->execute();
            $results = $stmt->fetchAll();
            foreach($results as $result){
                $this->carid = $result['CarID'];
                $this->numberplate = $result['CarPlate'];
                $this->car_type = $result['CarType'];
                $this->car_colour= $result['CarColour'];
                $this->timestamp = $result['time_in'];
            }
            
        }
        public function logout ($pdo){
            session_destroy();
        }

        /**
         * Get the value of carid
         */ 
        public function getCarid()
        {
                return $this->carid;
        }

        /**
         * Set the value of carid
         *
         * @return  self
         */ 
        public function setCarid($carid)
        {
                $this->carid = $carid;

                return $this;
        }

        /**
         * Get the value of timestamp
         */ 
        public function getTimestamp()
        {
                return $this->timestamp;
        }

        /**
         * Set the value of timestamp
         *
         * @return  self
         */ 
        public function setTimestamp($timestamp)
        {
                $this->timestamp = $timestamp;

                return $this;
        }
    } 

?>