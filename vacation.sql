

CREATE DATABASE vst_vacation CHARSET UTF8;

USE vst_vacation;


CREATE TABLE vacation_user(
  id INT(10) UNSIGNED PRIMARY KEY AUTO_INCREMENT COMMENT '用户索引',
  userName CHAR(20) NOT NULL COMMENT '账号',
  password VARCHAR(100) NOT NULL COMMENT '密码' ,
  realName CHAR(20) NOT NULL COMMENT '用户名' ,
  phoneNum CHAR(11) NOT NULL COMMENT '手机号码' ,
  createTime INT(10) UNSIGNED NOT NULL COMMENT '用户创建时间',
  lastTime INT(10) UNSIGNED NOT NULL COMMENT '用户后一次登录时间'
)ENGINE MYISAM CHARSET UTF8;


CREATE TABLE vacation_overtime(
  id INT(10) UNSIGNED PRIMARY KEY AUTO_INCREMENT COMMENT '加班索引',
  userId INT(10) UNSIGNED NOT NULL COMMENT '用户ID',
  realName CHAR(20) NOT NULL COMMENT '用户名' ,
  vacaType TINYINT(1) UNSIGNED NOT NULL COMMENT '1是加班2是调休',
  startTime INT(10) UNSIGNED NOT NULL COMMENT '开始时间',
  endTime INT(10) UNSIGNED NOT NULL COMMENT '结束时间' ,
  reason  TEXT NOT NULL  COMMENT '加班/调休事由',
  totalTime FLOAT(3,1) UNSIGNED NOT NULL COMMENT '时长',
  createTime INT(10) UNSIGNED NOT NULL COMMENT '创建时间',
  updateTime INT(10) UNSIGNED NOT NULL COMMENT '修改时间'
)ENGINE MYISAM CHARSET UTF8;


INSERT INTO vacation_user
(userName,password,realName,phoneNum,createTime,lastTime)
VALUES
('admin','123456','admin','13603041983',1479111882,1479111882);









