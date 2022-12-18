USE merocari;
CREATE TABLE IF NOT EXISTS ProductCategory (
    id          INT     AUTO_INCREMENT,
    product_id  INT     NOT NULL,
    category_cd char(3) NOT NULL,

    UNIQUE KEY (product_id, category_cd),   -- 2つのカラムの組み合わせが重複しない
    PRIMARY KEY (id)
);