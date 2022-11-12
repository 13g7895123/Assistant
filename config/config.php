<?php
//API設定
const DOMAIN = 'light.eng-astra.com.tw'; //測試
//const DOMAIN = '3tsai.net.tw'; //正式
const API_URL = "https://" . DOMAIN . "/service/api.php";
const PAYMENT_URL = "https://payment.eng-astra.com.tw/service/api.php"; //測試金流平台API
//const PAYMENT_URL = "https://payment.astra.com.tw/service/api.php"; //正式金流平台API

//連線資料庫設定
const SQLPORT_SQL = '3306'; //資料庫port
const HOSTNAME_SQL = 'localhost'; //資料庫位址
const USERNAME_SQL = 'assistant_user'; //帳號
const PASSWORD_SQL = '820820'; //密碼
const DATABASE_SQL = 'db_assistant'; //資料庫名稱
const SESSION_TIMEOUT = 86400; //session保留時間(單位秒)

/*
  米奇簡訊平台設定
  MIKI_SMS_USERNAME 帳號
  MIKI_SMS_PASSWORD 密碼
 */
const MIKI_SMS_USERNAME = '0910653517';
const MIKI_SMS_PASSWORD = 'Astrawm232';

//SFTP設定(backup用)(通用，勿改值)
const SFTP_HOST = 'winmai.synology.me'; //SFTP位址
const SFTP_USERNAME = 'astra_sftp'; //SFTP使用者帳號
const SFTP_PASSWORD = '1y!tyo0f'; //SFTP密碼
const SFTP_PORT = 22; //SFTP port
const SFTP_PATH = '/PSD_Backup/server_backup/'; //SFTP存放路徑

//API驗證帳密
const AUTH_USER = "user";
const AUTH_PW = "password";

// error message
const SUCCESS = "SUCCESS";
const ERROR = "ERROR";
const CONNECT_FAIL = "CONNECT_FAIL";
const NO_DATA = "NO_DATA";

// Regex
const REGEX_DATE_TO_YEAR = "/-.+$/";

//圖片1(商品圖)尺寸
const PRODUCT_PIC1_WIDTH = 256;
const PRODUCT_PIC1_HEIGHT = 256;

//圖片2(商品介紹圖)尺寸
const PRODUCT_PIC2_WIDTH = 1080;
const PRODUCT_PIC2_HEIGHT = 530;
?>