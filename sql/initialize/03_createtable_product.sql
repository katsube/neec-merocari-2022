CREATE TABLE IF NOT EXISTS Product (
    id          int            AUTO_INCREMENT,
    name        varchar(256)   NOT NULL,
    price       int            NOT NULL,
    image_url   varchar(256)   NOT NULL,
    category_cd char(3)        NOT NULL,
    description varchar(4096),
    created_at  datetime,

    PRIMARY KEY (id)
);
