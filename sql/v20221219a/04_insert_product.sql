/**
 * 商品のサンプルデータ
 *
 */
INSERT INTO Product (name, price, image_url, description, created_at)
VALUES
    ('浜名湖のうなぎ',   2000, '/image/product/unagi.jpg',  '職人が焼いた美味しい鰻の蒲焼き。',           now()),
    ('北海道のいくら',   3000, '/image/product/ikura.jpg',  'クマさんから奪い取った伝説のいくら。',       now()),
    ('大間のマグロ',     5000, '/image/product/maguro.jpg', '初競りで1688万円の音を付けたマグロです。',   now()),
    ('北海道のメロン',   2800, '/image/product/meron.jpg',  'ベリーメロン。私の心をつかんだ良いメロン。', now()),
    ('伝説の豚の角煮',   1500, '/image/product/nibuta.jpg', 'お肌がプルプルになるコラーゲンが豊富！',     now()),
    ('徳島ラーメン',     1000, '/image/product/ramen.jpg',  'お肉たっぷり。生卵もご一緒に',               now()),
    ('ゆっくりステーキ', 4000, '/image/product/steak.jpg',  'ゆっくりしていってね!!!(生首AA)',            now()),
    ('栃木のいちご',     3200, '/image/product/ichigo.jpg', 'とちおとめ10kgセットです',                   now())
    ;

INSERT INTO ProductCategory (product_id, category_cd)
VALUES
    (1, 'MEN'),    -- うなぎ1
    (1, 'WOM'),    -- うなぎ2
    (1, 'BAB'),    -- うなぎ3
    (2, 'MEN'),    -- いくら1
    (2, 'ETC'),    -- いくら2
    (3, 'MEN'),    -- マグロ1
    (4, 'WOM'),    -- メロン1
    (5, 'WOM'),    -- 豚の角煮1
    (6, 'WOM'),    -- ラーメン1
    (7, 'BAB'),    -- ステーキ1
    (8, 'BAB')     -- いちご1
    ;
