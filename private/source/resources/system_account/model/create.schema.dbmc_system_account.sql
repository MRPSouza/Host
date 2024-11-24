create schema if not exists dbmc_system_account default character set utf8mb4 collate utf8mb4_unicode_ci;

create table if not exists dbmc_system_account.tb_user
(
  id int auto_increment primary key comment 'Identificador do usuário',
  userName_str varchar(50) not null comment 'Nome de usuário'
);

create table if not exists dbmc_system_account.tb_email
(
  id int auto_increment primary key comment 'Identificador do email',
  user_fk int not null comment 'Identificador do usuário',
  email_str varchar(70) not null comment 'Email do usuário',
  foreign key (user_fk) references dbmc_system_account.tb_user(id)
);

create table if not exists dbmc_system_account.tb_password
(
  id int auto_increment primary key comment 'Identificador da senha',
  email_fk int not null comment 'Identificador do email',
  hashPass_str varchar(255) not null comment 'Hash da senha',
  password_salt varchar(255) not null comment 'Salt da senha',
  foreign key (email_fk) references dbmc_system_account.tb_email(id)
);

CREATE TABLE tb_email_verification (
    id INT PRIMARY KEY AUTO_INCREMENT,
    email_str VARCHAR(255) NOT NULL,
    token_str VARCHAR(64) NOT NULL,
    expiration_dt DATETIME NOT NULL,
    verified TINYINT(1) DEFAULT 0,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    UNIQUE KEY unique_token (token_str)
);

ALTER TABLE tb_email
ADD COLUMN verified TINYINT(1) DEFAULT 0;

USE dbmc_system_account;
    delimiter //
    create trigger no_spaces_trigger_insert
    before insert on tb_user
    for each row
    begin
        if new.userName_str like '% %' then
            signal sqlstate '45000'
            set message_text = 'O campo username não pode conter espaços!';
        end if; 
    end;
    //
    delimiter ;

    delimiter //
    create trigger no_spaces_trigger_update
    before update on dbmc_system_account.tb_user
    for each row
    begin
        if new.userName_str like '% %' then
            signal sqlstate '45000'
            set message_text = 'O campo username não pode conter espaços!';
        end if; 
    end;
    //
    delimiter ;