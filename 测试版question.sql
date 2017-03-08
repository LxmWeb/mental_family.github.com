/*
Navicat MySQL Data Transfer

Source Server         : aliyun
Source Server Version : 50534
Source Host           : 139.224.133.40:3306
Source Database       : xinlijia

Target Server Type    : MYSQL
Target Server Version : 50534
File Encoding         : 65001

Date: 2017-03-08 20:06:40
*/

SET FOREIGN_KEY_CHECKS=0;
-- ----------------------------
-- Table structure for `question`
-- ----------------------------
DROP TABLE IF EXISTS `question`;
CREATE TABLE `question` (
  `QuestionnaireId` int(11) NOT NULL DEFAULT '0',
  `QuestionId` int(11) NOT NULL DEFAULT '0',
  `Question` varchar(255) CHARACTER SET latin1 DEFAULT NULL,
  `QuestionDegree` int(1) DEFAULT NULL,
  PRIMARY KEY (`QuestionnaireId`,`QuestionId`),
  CONSTRAINT `question_ibfk_1` FOREIGN KEY (`QuestionnaireId`) REFERENCES `questionnaire` (`questionnaireId`)
) ENGINE=InnoDB DEFAULT CHARSET=gb2312;

-- ----------------------------
-- Records of question
-- ----------------------------
INSERT INTO question VALUES ('1', '1', '是否经常感觉到心情压抑', '4');
INSERT INTO question VALUES ('1', '2', '是否会感到自卑', '4');
INSERT INTO question VALUES ('1', '3', '在过去12个月中，你失眠的频率程度是', '4');
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
  `questionnaireName` varchar(255) DEFAULT NULL,
  `questionnaireTag` varchar(255) DEFAULT NULL,
  `questionnaireScore` int(2) DEFAULT NULL,
  `questionnaireOwnerId` varchar(255) NOT NULL,
  PRIMARY KEY (`questionnaireId`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=gb2312;

-- ----------------------------
-- Records of questionnaire
-- ----------------------------
INSERT INTO questionnaire VALUES ('1', 'yi yu ni zhi dao ma ?', 'yiyu', null, '17816869761');
INSERT INTO questionnaire VALUES ('2', '456', '456', null, '17816869761');
INSERT INTO questionnaire VALUES ('3', '789', '789', null, '17816869761');
