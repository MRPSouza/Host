create schema if not exists db_accesses default character set utf8mb4 collate utf8mb4_unicode_ci;

create table if not exists db_accesses.tb_accesses (
    id int auto_increment primary key
,   userName varchar (50) not null unique, 
    check (userName REGEXP '^[A-Za-z0-9_#]+$')
,   createdAt datetime default current_timestamp
,   updatedAt datetime default current_timestamp on update current_timestamp
) engine = InnoDB default charset = utf8mb4 collate = utf8mb4_unicode_ci;

create table if not exists db_accesses.tb_emails (
    id int auto_increment primary key
,   email varchar (100) not null unique, check (email <> '' and email <> ' ' and email <> '% %')
,   createdAt datetime default current_timestamp
,   updatedAt datetime default current_timestamp on update current_timestamp
) engine = InnoDB default charset = utf8mb4 collate = utf8mb4_unicode_ci;

create table if not exists db_accesses.tb_passwords (
    id int auto_increment primary key
,   password varchar (256) not null
,   createdAt datetime default current_timestamp
,   updatedAt datetime default current_timestamp on update current_timestamp
) engine = InnoDB default charset = utf8mb4 collate = utf8mb4_unicode_ci;

USE db_accesses;
    delimiter //
    create trigger no_invalid_chars_trigger_insert
    before insert on db_accesses.accesses
    for each row
    begin
        if new.userName_var50 NOT REGEXP '^[A-Za-z0-9_#]+$' then
            signal sqlstate '45000'
            set message_text = 'O campo username só pode conter letras, números, underscore (_) e hashtag (#)';
        end if; 
    end;
    //
    delimiter ;

    delimiter //
    create trigger no_invalid_chars_trigger_update
    before update on db_accesses.accesses
    for each row
    begin
        if new.userName_var50 NOT REGEXP '^[A-Za-z0-9_#]+$' then
            signal sqlstate '45000'
            set message_text = 'O campo username só pode conter letras, números, underscore (_) e hashtag (#)';
        end if; 
    end;
    //
    delimiter ;

