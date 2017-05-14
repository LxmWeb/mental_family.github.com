/*
Navicat MySQL Data Transfer

Source Server         : aliyun
Source Server Version : 50534
Source Host           : 139.224.133.40:3306
Source Database       : xinlijia

Target Server Type    : MYSQL
Target Server Version : 50534
File Encoding         : 65001

Date: 2017-03-18 21:37:00
*/

SET FOREIGN_KEY_CHECKS=0;
-- ----------------------------
-- Table structure for `docPush`
-- ----------------------------
DROP TABLE IF EXISTS `docPush`;
CREATE TABLE `docPush` (
  `push_id` int(11) NOT NULL AUTO_INCREMENT,
  `doctor_id` varchar(11) NOT NULL,
  `patient_id` varchar(11) NOT NULL,
  `questionnaireId` int(11) NOT NULL,
  `questionnaireName` varchar(255) CHARACTER SET utf8 DEFAULT NULL,
  `pushTime` datetime NOT NULL,
  `ifRead` int(11) NOT NULL DEFAULT '0',
  `ifFinish` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`push_id`),
  KEY `doctor_id` (`doctor_id`),
  KEY `patient_id` (`patient_id`),
  CONSTRAINT `doctor_id` FOREIGN KEY (`doctor_id`) REFERENCES `doctor_0318` (`doctor_id`),
  CONSTRAINT `patient_id` FOREIGN KEY (`patient_id`) REFERENCES `patient_0318` (`patient_id`)
) ENGINE=InnoDB AUTO_INCREMENT=44 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of docPush
-- ----------------------------
INSERT INTO docPush VALUES ('22', '17816869761', '17816869781', '2', null, '2017-03-13 01:40:49', '0', '0');
INSERT INTO docPush VALUES ('23', '17816869761', '17816869781', '3', null, '2017-03-13 01:40:49', '0', '0');
INSERT INTO docPush VALUES ('24', '17816869761', '17816869781', '1', null, '2017-03-13 01:41:00', '0', '0');
INSERT INTO docPush VALUES ('25', '17816869761', '17816869781', '2', null, '2017-03-13 01:41:00', '0', '0');
INSERT INTO docPush VALUES ('26', '17816869761', '17816869781', '7', null, '2017-03-13 01:41:15', '0', '0');
INSERT INTO docPush VALUES ('27', '17816869761', '17816869781', '1', null, '2017-03-13 01:49:00', '0', '0');
INSERT INTO docPush VALUES ('28', '17816869761', '17816869781', '2', null, '2017-03-13 01:49:00', '0', '0');
INSERT INTO docPush VALUES ('29', '17816869761', '17816869781', '5', null, '2017-03-13 01:49:09', '0', '0');
INSERT INTO docPush VALUES ('30', '17816869761', '17816869781', '5', null, '2017-03-13 01:49:23', '0', '0');
INSERT INTO docPush VALUES ('31', '17816869761', '17816869781', '1', null, '2017-03-13 01:50:12', '0', '0');
INSERT INTO docPush VALUES ('32', '17816869761', '17816869781', '7', null, '2017-03-13 02:00:06', '0', '0');
INSERT INTO docPush VALUES ('33', '17816869761', '17816869781', '2', null, '2017-03-13 04:35:27', '0', '0');
INSERT INTO docPush VALUES ('34', '17816869761', '17816869781', '3', null, '2017-03-13 04:35:27', '0', '0');
INSERT INTO docPush VALUES ('35', '17816869761', '17816869781', '2', null, '2017-03-13 04:38:22', '0', '0');
INSERT INTO docPush VALUES ('36', '17816869761', '17816869781', '5', null, '2017-03-13 04:38:22', '0', '0');
INSERT INTO docPush VALUES ('37', '17816869761', '17816869781', '2', null, '2017-03-13 04:38:22', '0', '0');
INSERT INTO docPush VALUES ('38', '17816869761', '17816869739', '4', null, '2017-03-13 04:49:44', '0', '0');
INSERT INTO docPush VALUES ('39', '17816869761', '17816869781', '3', null, '2017-03-13 06:01:35', '0', '0');
INSERT INTO docPush VALUES ('40', '17816869761', '17816869781', '5', null, '2017-03-13 06:01:35', '0', '0');
INSERT INTO docPush VALUES ('41', '17816869761', '17816869781', '7', null, '2017-03-13 06:01:47', '0', '0');
INSERT INTO docPush VALUES ('42', '17816869761', '17816869781', '3', null, '2017-03-18 11:23:07', '0', '0');
INSERT INTO docPush VALUES ('43', '17816869761', '17816869781', '1', null, '2017-03-18 11:29:57', '0', '0');

-- ----------------------------
-- Table structure for `doctor`
-- ----------------------------
DROP TABLE IF EXISTS `doctor`;
CREATE TABLE `doctor` (
  `doctor_id` varchar(11) NOT NULL,
  `doctor_name` varchar(16) CHARACTER SET utf8 NOT NULL,
  `sex` char(2) DEFAULT NULL,
  `birthday` date DEFAULT NULL,
  `identity` varchar(18) CHARACTER SET utf8 NOT NULL,
  `education` varchar(30) CHARACTER SET utf8 DEFAULT NULL,
  `working_place` int(11) NOT NULL,
  `department` varchar(20) CHARACTER SET utf8 DEFAULT NULL,
  `treatment` varchar(24) CHARACTER SET utf8 NOT NULL,
  `positional_title` varchar(20) CHARACTER SET utf8 DEFAULT NULL,
  `head_image` varchar(20) DEFAULT NULL,
  `email` varchar(20) DEFAULT NULL,
  PRIMARY KEY (`doctor_id`),
  KEY `working_place` (`working_place`),
  CONSTRAINT `doctor_ibfk_1` FOREIGN KEY (`working_place`) REFERENCES `hospital` (`hospital_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of doctor
-- ----------------------------
INSERT INTO doctor VALUES ('17816869761', '我的哥', 'm', '1978-09-09', '331111197809090000', '', '1', '', '抑郁', '', '', '');



-- ----------------------------
-- Table structure for `hospital`
-- ----------------------------
DROP TABLE IF EXISTS `hospital`;
CREATE TABLE `hospital` (
  `hospital_id` int(11) NOT NULL AUTO_INCREMENT,
  `hospital_name` varchar(30) CHARACTER SET utf8 NOT NULL,
  `address` varchar(50) CHARACTER SET utf8 NOT NULL,
  `phone_number` varchar(13) DEFAULT NULL,
  `brief_info` varchar(100) CHARACTER SET utf8 DEFAULT NULL,
  PRIMARY KEY (`hospital_id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;
-- ----------------------------
-- Records of hospital
-- ----------------------------
INSERT INTO hospital VALUES ('1', '辛德瑞拉', '余杭塘路123号', '124322321', '美丽');

-- ----------------------------
-- Table structure for `medical_record`
-- ----------------------------
DROP TABLE IF EXISTS `medical_record`;
CREATE TABLE `medical_record` (
  `patient_id` varchar(5) NOT NULL,
  `test_time` date NOT NULL,
  `test_title` varchar(50) NOT NULL,
  `test_score` int(11) DEFAULT NULL,
  `test_result` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`patient_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of medical_record
-- ----------------------------

-- ----------------------------
-- Table structure for `patient`
-- ----------------------------
DROP TABLE IF EXISTS `patient`;
CREATE TABLE `patient` (
  `patient_id` varchar(11) NOT NULL,
  `patient_name` varchar(16) CHARACTER SET utf8 NOT NULL,
  `sex` char(1) DEFAULT NULL,
  `birthday` date DEFAULT NULL,
  `identity` varchar(18) CHARACTER SET utf8 NOT NULL,
  `main_suit` varchar(100) CHARACTER SET utf8 DEFAULT NULL,
  `head_image` varchar(20) DEFAULT NULL,
  `email` varchar(20) DEFAULT NULL,
  PRIMARY KEY (`patient_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of patient
-- ----------------------------
INSERT INTO patient VALUES ('17816869739', '阿汪', 'm', '1985-02-15', '300000000000000000', '强迫', 'img17816869739', '123@123.com');
INSERT INTO patient VALUES ('17816869781', '小明', 'f', '1978-09-09', '331111197809090000', '抑郁', 'img01.png', '12323423@qq.com');



-- ----------------------------
-- Table structure for `question`
-- ----------------------------
DROP TABLE IF EXISTS `question`;
CREATE TABLE `question` (
  `QuestionnaireId` int(11) NOT NULL DEFAULT '0',
  `QuestionId` int(11) NOT NULL DEFAULT '0',
  `Question` varchar(255) CHARACTER SET utf8 DEFAULT NULL,
  `QuestionDegree` int(1) DEFAULT NULL,
  PRIMARY KEY (`QuestionnaireId`,`QuestionId`),
  CONSTRAINT `question_ibfk_1` FOREIGN KEY (`QuestionnaireId`) REFERENCES `questionnaire` (`questionnaireId`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of question
-- ----------------------------
INSERT INTO question VALUES ('1', '1', '是否经常感觉到心情压抑', '4');
INSERT INTO question VALUES ('1', '2', '是否会感到自卑', '4');
INSERT INTO question VALUES ('1', '3', '在过去12个月中，你失眠的频率是', '4');
INSERT INTO question VALUES ('1', '4', '您认为在您当地，您家庭的经济状况属于', '4');
INSERT INTO question VALUES ('1', '5', '时候感觉记忆力衰退', '4');
INSERT INTO question VALUES ('1', '6', '性欲减退', '4');
INSERT INTO question VALUES ('1', '7', '是否经常有自杀的冲动', '4');
INSERT INTO question VALUES ('1', '8', '在最近十二个月里，因为经济压力所带来烦恼的频率', '4');
INSERT INTO question VALUES ('1', '9', '在工作学习中，感到注意力无法集中的频率', '4');
INSERT INTO question VALUES ('1', '10', '是否经常会渴望得到亲友的关爱、帮助', '4');
INSERT INTO question VALUES ('1', '11', '您认为您的童年是否充满愉快幸福', '4');
INSERT INTO question VALUES ('1', '12', '因为工作学习中的事情，发火的频率是', '4');
INSERT INTO question VALUES ('1', '13', '最近的体重变化很严重', '4');
INSERT INTO question VALUES ('1', '14', '依然保留以前的兴趣爱好', '4');
INSERT INTO question VALUES ('1', '15', '对于自己的外貌，是否满意', '4');
INSERT INTO question VALUES ('1', '16', '在过去六个月中，您的食欲怎样', '4');
INSERT INTO question VALUES ('1', '17', '是否经常感觉到很疲劳', '4');
INSERT INTO question VALUES ('1', '18', '生活中，处理事情时候经常犹豫不决', '4');
INSERT INTO question VALUES ('1', '19', '在日常生活中，时候喜欢和朋友在社交媒体上聊天', '4');
INSERT INTO question VALUES ('1', '20', '在工作学习之余，时候经常会进行体育锻炼', '4');
INSERT INTO question VALUES ('1', '21', '觉得身边人的无法信任', '4');
INSERT INTO question VALUES ('1', '22', '是否觉得生活很没乐趣', '4');
INSERT INTO question VALUES ('1', '23', '你认为您的家庭美满幸福吗', '4');
INSERT INTO question VALUES ('1', '24', '有没有经常感觉到很无助', '4');
INSERT INTO question VALUES ('1', '25', '是否有慢性病史和服用药物', '3');
INSERT INTO question VALUES ('1', '26', '有过较为严重的躯体疾病', '2');
INSERT INTO question VALUES ('1', '27', '是否酗酒', '2');
INSERT INTO question VALUES ('1', '28', '是否曾经有过自杀的行为', '2');
INSERT INTO question VALUES ('2', '1', '123456789', '1');
INSERT INTO question VALUES ('2', '2', '123456789', '2');
INSERT INTO question VALUES ('3', '1', '987654321', '2');

-- ----------------------------
-- Table structure for `questionnaire`
-- ----------------------------
DROP TABLE IF EXISTS `questionnaire`;
CREATE TABLE `questionnaire` (
  `questionnaireId` int(11) NOT NULL AUTO_INCREMENT,
  `questionnaireOwnerId` varchar(11) NOT NULL,
  `questionnaireName` varchar(255) CHARACTER SET utf8 DEFAULT NULL,
  `questionnaireTag` varchar(255) CHARACTER SET utf8 DEFAULT NULL,
  `questionnaireScore` int(2) DEFAULT NULL,
  PRIMARY KEY (`questionnaireId`,`questionnaireOwnerId`),
  KEY `questionnaireOwnerId` (`questionnaireOwnerId`),
  CONSTRAINT `questionnaireOwnerId` FOREIGN KEY (`questionnaireOwnerId`) REFERENCES `doctor_0318` (`doctor_id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of questionnaire
-- ----------------------------
INSERT INTO questionnaire VALUES ('1', '17816869761', '心理健康自评表', '心理健康', null);
INSERT INTO questionnaire VALUES ('1', 'admin', '心理健康自评表', '心理健康', null);
INSERT INTO questionnaire VALUES ('2', '17816869761', '456', '456', null);
INSERT INTO questionnaire VALUES ('2', 'admin', '456', '456', null);
INSERT INTO questionnaire VALUES ('3', '17816869761', '789', '789', null);
INSERT INTO questionnaire VALUES ('3', 'admin', '789', '789', null);
INSERT INTO questionnaire VALUES ('4', '17816869761', '545454545', '45454', null);
INSERT INTO questionnaire VALUES ('4', 'admin', '545454545', '45454', null);
INSERT INTO questionnaire VALUES ('5', '17816869761', '9898989', '8989', null);
INSERT INTO questionnaire VALUES ('5', 'admin', '9898989', '8989', null);
INSERT INTO questionnaire VALUES ('6', 'admin', '4646464', '46', null);
INSERT INTO questionnaire VALUES ('7', '17816869761', '00000000', '000', null);
INSERT INTO questionnaire VALUES ('7', 'admin', '00000000', '000', null);

-- ----------------------------
-- Table structure for `relationship`
-- ----------------------------
DROP TABLE IF EXISTS `relationship`;
CREATE TABLE `relationship` (
  `patient_id` varchar(11) NOT NULL,
  `doctor_id` varchar(11) NOT NULL,
  `patient_name` varchar(20) CHARACTER SET utf8 NOT NULL,
  `sex` char(1) NOT NULL,
  `birthday` date NOT NULL,
  `main_suit` varchar(50) CHARACTER SET utf8 NOT NULL,
  `build_time` date NOT NULL,
  `is_valid` tinyint(1) NOT NULL,
  PRIMARY KEY (`patient_id`),
  KEY `doctor_id` (`doctor_id`),
  CONSTRAINT `relationship_ibfk_2` FOREIGN KEY (`patient_id`) REFERENCES `patient` (`patient_id`),
  CONSTRAINT `relationship_ibfk_1` FOREIGN KEY (`doctor_id`) REFERENCES `doctor` (`doctor_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of relationship
-- ----------------------------
INSERT INTO relationship VALUES ('17816869739', '17816869761', '阿汪', 'm', '1985-02-15', '强迫', '2016-09-28', '1');
INSERT INTO relationship VALUES ('17816869781', '17816869761', '小明', 'f', '1978-09-09', '抑郁', '2017-03-11', '1');

-- ----------------------------
-- Table structure for `users`
-- ----------------------------
DROP TABLE IF EXISTS `users`;
CREATE TABLE `users` (
  `user_id` varchar(11) NOT NULL,
  `user_password` varchar(16) NOT NULL,
  `user_name` varchar(7) CHARACTER SET utf8 NOT NULL,
  `user_status` int(11) NOT NULL,
  `uniqid` varchar(40) CHARACTER SET utf8 DEFAULT NULL,
  `register_time` date DEFAULT NULL,
  `last_login_time` date DEFAULT NULL,
  `last_login_ip` varchar(16) DEFAULT NULL,
  PRIMARY KEY (`user_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of users
-- ----------------------------
INSERT INTO users VALUES ('17816869729', '111111', '阿姣', '2', null, null, null, null);
INSERT INTO users VALUES ('17816869761', '123456', '妮妮', '2', '', '2017-03-06', '2017-03-06', '127.0.0.1');
INSERT INTO users VALUES ('17816869781', '123456', '明儿', '1', '', '2017-03-06', '2017-03-06', '127.0.0.1');
