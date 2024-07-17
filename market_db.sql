PGDMP      0                |         	   market_db    16.3 (Debian 16.3-1.pgdg120+1)     16.3 (Ubuntu 16.3-1.pgdg22.04+1) 1    Q           0    0    ENCODING    ENCODING        SET client_encoding = 'UTF8';
                      false            R           0    0 
   STDSTRINGS 
   STDSTRINGS     (   SET standard_conforming_strings = 'on';
                      false            S           0    0 
   SEARCHPATH 
   SEARCHPATH     8   SELECT pg_catalog.set_config('search_path', '', false);
                      false            T           1262    16384 	   market_db    DATABASE     t   CREATE DATABASE market_db WITH TEMPLATE = template0 ENCODING = 'UTF8' LOCALE_PROVIDER = libc LOCALE = 'en_US.utf8';
    DROP DATABASE market_db;
                my_user    false                        2615    2200    public    SCHEMA        CREATE SCHEMA public;
    DROP SCHEMA public;
                pg_database_owner    false            U           0    0    SCHEMA public    COMMENT     6   COMMENT ON SCHEMA public IS 'standard public schema';
                   pg_database_owner    false    4            �            1259    16453    product    TABLE       CREATE TABLE public.product (
    id integer NOT NULL,
    name character varying(255) NOT NULL,
    description text,
    price_in_cents integer NOT NULL,
    unit character varying(50),
    brand character varying(100),
    observation text,
    product_type_id integer NOT NULL
);
    DROP TABLE public.product;
       public         heap    my_user    false    4            �            1259    16452    product_id_seq    SEQUENCE     �   CREATE SEQUENCE public.product_id_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;
 %   DROP SEQUENCE public.product_id_seq;
       public          my_user    false    220    4            V           0    0    product_id_seq    SEQUENCE OWNED BY     A   ALTER SEQUENCE public.product_id_seq OWNED BY public.product.id;
          public          my_user    false    219            �            1259    16437    product_type    TABLE     �   CREATE TABLE public.product_type (
    id integer NOT NULL,
    name character varying(255) NOT NULL,
    description text,
    tax integer NOT NULL
);
     DROP TABLE public.product_type;
       public         heap    my_user    false    4            �            1259    16436    product_type_id_seq    SEQUENCE     �   CREATE SEQUENCE public.product_type_id_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;
 *   DROP SEQUENCE public.product_type_id_seq;
       public          my_user    false    216    4            W           0    0    product_type_id_seq    SEQUENCE OWNED BY     K   ALTER SEQUENCE public.product_type_id_seq OWNED BY public.product_type.id;
          public          my_user    false    215            �            1259    16491    product_type_view    VIEW     t   CREATE VIEW public.product_type_view AS
 SELECT id,
    name,
    description,
    tax
   FROM public.product_type;
 $   DROP VIEW public.product_type_view;
       public          my_user    false    216    216    216    216    4            �            1259    16503    product_view    VIEW     �   CREATE VIEW public.product_view AS
 SELECT id,
    name,
    description,
    price_in_cents,
    unit,
    brand,
    observation,
    product_type_id
   FROM public.product;
    DROP VIEW public.product_view;
       public          my_user    false    220    220    220    220    220    220    220    220    4            �            1259    16446    sale    TABLE     j   CREATE TABLE public.sale (
    id integer NOT NULL,
    sale_time timestamp without time zone NOT NULL
);
    DROP TABLE public.sale;
       public         heap    my_user    false    4            �            1259    16445    sale_id_seq    SEQUENCE     �   CREATE SEQUENCE public.sale_id_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;
 "   DROP SEQUENCE public.sale_id_seq;
       public          my_user    false    4    218            X           0    0    sale_id_seq    SEQUENCE OWNED BY     ;   ALTER SEQUENCE public.sale_id_seq OWNED BY public.sale.id;
          public          my_user    false    217            �            1259    16467    sale_product    TABLE     �   CREATE TABLE public.sale_product (
    id integer NOT NULL,
    sale_id integer NOT NULL,
    product_id integer NOT NULL,
    quantity integer NOT NULL,
    price_in_cents integer NOT NULL
);
     DROP TABLE public.sale_product;
       public         heap    my_user    false    4            �            1259    16466    sale_product_id_seq    SEQUENCE     �   CREATE SEQUENCE public.sale_product_id_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;
 *   DROP SEQUENCE public.sale_product_id_seq;
       public          my_user    false    222    4            Y           0    0    sale_product_id_seq    SEQUENCE OWNED BY     K   ALTER SEQUENCE public.sale_product_id_seq OWNED BY public.sale_product.id;
          public          my_user    false    221            �            1259    16507    sale_total_price_view    VIEW     �   CREATE VIEW public.sale_total_price_view AS
SELECT
    NULL::integer AS id,
    NULL::timestamp without time zone AS sale_time,
    NULL::bigint AS price_in_cents;
 (   DROP VIEW public.sale_total_price_view;
       public          my_user    false    4            �           2604    16456 
   product id    DEFAULT     h   ALTER TABLE ONLY public.product ALTER COLUMN id SET DEFAULT nextval('public.product_id_seq'::regclass);
 9   ALTER TABLE public.product ALTER COLUMN id DROP DEFAULT;
       public          my_user    false    219    220    220            �           2604    16440    product_type id    DEFAULT     r   ALTER TABLE ONLY public.product_type ALTER COLUMN id SET DEFAULT nextval('public.product_type_id_seq'::regclass);
 >   ALTER TABLE public.product_type ALTER COLUMN id DROP DEFAULT;
       public          my_user    false    216    215    216            �           2604    16449    sale id    DEFAULT     b   ALTER TABLE ONLY public.sale ALTER COLUMN id SET DEFAULT nextval('public.sale_id_seq'::regclass);
 6   ALTER TABLE public.sale ALTER COLUMN id DROP DEFAULT;
       public          my_user    false    218    217    218            �           2604    16470    sale_product id    DEFAULT     r   ALTER TABLE ONLY public.sale_product ALTER COLUMN id SET DEFAULT nextval('public.sale_product_id_seq'::regclass);
 >   ALTER TABLE public.sale_product ALTER COLUMN id DROP DEFAULT;
       public          my_user    false    221    222    222            L          0    16453    product 
   TABLE DATA           s   COPY public.product (id, name, description, price_in_cents, unit, brand, observation, product_type_id) FROM stdin;
    public          my_user    false    220   �7       H          0    16437    product_type 
   TABLE DATA           B   COPY public.product_type (id, name, description, tax) FROM stdin;
    public          my_user    false    216   8       J          0    16446    sale 
   TABLE DATA           -   COPY public.sale (id, sale_time) FROM stdin;
    public          my_user    false    218   ]8       N          0    16467    sale_product 
   TABLE DATA           Y   COPY public.sale_product (id, sale_id, product_id, quantity, price_in_cents) FROM stdin;
    public          my_user    false    222   �8       Z           0    0    product_id_seq    SEQUENCE SET     <   SELECT pg_catalog.setval('public.product_id_seq', 3, true);
          public          my_user    false    219            [           0    0    product_type_id_seq    SEQUENCE SET     A   SELECT pg_catalog.setval('public.product_type_id_seq', 3, true);
          public          my_user    false    215            \           0    0    sale_id_seq    SEQUENCE SET     9   SELECT pg_catalog.setval('public.sale_id_seq', 9, true);
          public          my_user    false    217            ]           0    0    sale_product_id_seq    SEQUENCE SET     B   SELECT pg_catalog.setval('public.sale_product_id_seq', 12, true);
          public          my_user    false    221            �           2606    16460    product product_pkey 
   CONSTRAINT     R   ALTER TABLE ONLY public.product
    ADD CONSTRAINT product_pkey PRIMARY KEY (id);
 >   ALTER TABLE ONLY public.product DROP CONSTRAINT product_pkey;
       public            my_user    false    220            �           2606    16444    product_type product_type_pkey 
   CONSTRAINT     \   ALTER TABLE ONLY public.product_type
    ADD CONSTRAINT product_type_pkey PRIMARY KEY (id);
 H   ALTER TABLE ONLY public.product_type DROP CONSTRAINT product_type_pkey;
       public            my_user    false    216            �           2606    16451    sale sale_pkey 
   CONSTRAINT     L   ALTER TABLE ONLY public.sale
    ADD CONSTRAINT sale_pkey PRIMARY KEY (id);
 8   ALTER TABLE ONLY public.sale DROP CONSTRAINT sale_pkey;
       public            my_user    false    218            �           2606    16472    sale_product sale_product_pkey 
   CONSTRAINT     \   ALTER TABLE ONLY public.sale_product
    ADD CONSTRAINT sale_product_pkey PRIMARY KEY (id);
 H   ALTER TABLE ONLY public.sale_product DROP CONSTRAINT sale_product_pkey;
       public            my_user    false    222            �           1259    16484    idx_product_name    INDEX     D   CREATE INDEX idx_product_name ON public.product USING btree (name);
 $   DROP INDEX public.idx_product_name;
       public            my_user    false    220            �           1259    16485    idx_product_price_in_cents    INDEX     X   CREATE INDEX idx_product_price_in_cents ON public.product USING btree (price_in_cents);
 .   DROP INDEX public.idx_product_price_in_cents;
       public            my_user    false    220            �           1259    16486    idx_product_product_type_id    INDEX     Z   CREATE INDEX idx_product_product_type_id ON public.product USING btree (product_type_id);
 /   DROP INDEX public.idx_product_product_type_id;
       public            my_user    false    220            �           1259    16483    idx_product_type_name    INDEX     N   CREATE INDEX idx_product_type_name ON public.product_type USING btree (name);
 )   DROP INDEX public.idx_product_type_name;
       public            my_user    false    216            �           1259    16490    idx_sale_product_price_in_cents    INDEX     b   CREATE INDEX idx_sale_product_price_in_cents ON public.sale_product USING btree (price_in_cents);
 3   DROP INDEX public.idx_sale_product_price_in_cents;
       public            my_user    false    222            �           1259    16489    idx_sale_product_product_id    INDEX     Z   CREATE INDEX idx_sale_product_product_id ON public.sale_product USING btree (product_id);
 /   DROP INDEX public.idx_sale_product_product_id;
       public            my_user    false    222            �           1259    16488    idx_sale_product_sale_id    INDEX     T   CREATE INDEX idx_sale_product_sale_id ON public.sale_product USING btree (sale_id);
 ,   DROP INDEX public.idx_sale_product_sale_id;
       public            my_user    false    222            �           1259    16487    idx_sale_sale_time    INDEX     H   CREATE INDEX idx_sale_sale_time ON public.sale USING btree (sale_time);
 &   DROP INDEX public.idx_sale_sale_time;
       public            my_user    false    218            F           2618    16510    sale_total_price_view _RETURN    RULE       CREATE OR REPLACE VIEW public.sale_total_price_view AS
 SELECT s.id,
    s.sale_time,
    COALESCE(sum(sp.price_in_cents), (0)::bigint) AS price_in_cents
   FROM (public.sale s
     LEFT JOIN public.sale_product sp ON ((s.id = sp.sale_id)))
  GROUP BY s.id;
 �   CREATE OR REPLACE VIEW public.sale_total_price_view AS
SELECT
    NULL::integer AS id,
    NULL::timestamp without time zone AS sale_time,
    NULL::bigint AS price_in_cents;
       public          my_user    false    218    222    222    3239    218    225            �           2606    16461 $   product product_product_type_id_fkey    FK CONSTRAINT     �   ALTER TABLE ONLY public.product
    ADD CONSTRAINT product_product_type_id_fkey FOREIGN KEY (product_type_id) REFERENCES public.product_type(id);
 N   ALTER TABLE ONLY public.product DROP CONSTRAINT product_product_type_id_fkey;
       public          my_user    false    216    220    3236            �           2606    16478 )   sale_product sale_product_product_id_fkey    FK CONSTRAINT     �   ALTER TABLE ONLY public.sale_product
    ADD CONSTRAINT sale_product_product_id_fkey FOREIGN KEY (product_id) REFERENCES public.product(id);
 S   ALTER TABLE ONLY public.sale_product DROP CONSTRAINT sale_product_product_id_fkey;
       public          my_user    false    222    220    3244            �           2606    16473 &   sale_product sale_product_sale_id_fkey    FK CONSTRAINT     �   ALTER TABLE ONLY public.sale_product
    ADD CONSTRAINT sale_product_sale_id_fkey FOREIGN KEY (sale_id) REFERENCES public.sale(id);
 P   ALTER TABLE ONLY public.sale_product DROP CONSTRAINT sale_product_sale_id_fkey;
       public          my_user    false    222    3239    218            L   G   x�3�(�O)-���440�C.#�Xr��gJjqrQfAIf~��!XI�gRQb^
'��1�*��b���� QS�      H   ;   x�3�,�,�W0�,I-.I�4�2���/�W ���*委��+srp㓌���� �4�      J   E   x�m˹�@����8�~�Ʈ����HG۔�9%�e5�Q�^�|��5z�G}���$�W�����      N   =   x�=���@�jj�����v��s�Hq	QM�ǣs�4ݡŵ9�{G�#��j���zI��
�     