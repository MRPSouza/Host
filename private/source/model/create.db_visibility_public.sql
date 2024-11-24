create schema if not exists db_visibility_public default character set utf8mb4 collate utf8mb4_unicode_ci;

create table if not exists db_visibility_public.tb_visibility (
    id int auto_increment primary key
,   visibility varchar (50) not null unique
,   createdAt datetime default current_timestamp
,   updatedAt datetime default current_timestamp on update current_timestamp
) engine = InnoDB default charset = utf8mb4 collate = utf8mb4_unicode_ci;

create table if not exists db_visibility_public.tb_users_visibility (
    id int auto_increment primary key
,   user_fk int not null, foreign key (user_fk) references db_accesses.accesses(id)
,   visibility_fk int not null, foreign key (visibility_fk) references db_visibility_public.visibility(id)
,   createdAt datetime default current_timestamp
,   updatedAt datetime default current_timestamp on update current_timestamp
) engine = InnoDB default charset = utf8mb4 collate = utf8mb4_unicode_ci;

create table if not exists db_visibility_public.tb_emails_visibility (
    id int auto_increment primary key
,   user_fk int not null, foreign key (user_fk) references db_accesses.accesses(id)
,   visibility_fk int not null, foreign key (visibility_fk) references db_visibility_public.visibility(id)
,   createdAt datetime default current_timestamp
,   updatedAt datetime default current_timestamp on update current_timestamp
) engine = InnoDB default charset = utf8mb4 collate = utf8mb4_unicode_ci;

create table if not exists db_visibility_public.tb_phones_visibility (
    id int auto_increment primary key
,   user_fk int not null, foreign key (user_fk) references db_accesses.accesses(id)
,   visibility_fk int not null, foreign key (visibility_fk) references db_visibility_public.visibility(id)
,   createdAt datetime default current_timestamp
,   updatedAt datetime default current_timestamp on update current_timestamp
) engine = InnoDB default charset = utf8mb4 collate = utf8mb4_unicode_ci;


insert ignore into db_visibility_public.tb_visibility (visibility) 
values 
    ('only_me_and_admins')
,   ('only_me_and_coworkers')
,   ('only_me_and_friends')
,   ('only_me_and_followers')
,   ('only_me_and_followers_of_followers')
,   ('everyone')
;
