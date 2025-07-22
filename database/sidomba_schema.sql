--
-- PostgreSQL database dump
--

-- Dumped from database version 16.2 (Postgres.app)
-- Dumped by pg_dump version 17.4

SET statement_timeout = 0;
SET lock_timeout = 0;
SET idle_in_transaction_session_timeout = 0;
SET transaction_timeout = 0;
SET client_encoding = 'UTF8';
SET standard_conforming_strings = on;
SELECT pg_catalog.set_config('search_path', '', false);
SET check_function_bodies = false;
SET xmloption = content;
SET client_min_messages = warning;
SET row_security = off;

--
-- Name: cage_type_enum; Type: TYPE; Schema: public; Owner: postgres
--

CREATE TYPE public.cage_type_enum AS ENUM (
    'breeding',
    'fattening'
);


ALTER TYPE public.cage_type_enum OWNER TO postgres;

--
-- Name: gender_type; Type: TYPE; Schema: public; Owner: postgres
--

CREATE TYPE public.gender_type AS ENUM (
    'male',
    'female'
);


ALTER TYPE public.gender_type OWNER TO postgres;

--
-- Name: pan_enum; Type: TYPE; Schema: public; Owner: postgres
--

CREATE TYPE public.pan_enum AS ENUM (
    'kawin',
    'bunting',
    'menyusui',
    'fattening'
);


ALTER TYPE public.pan_enum OWNER TO postgres;

--
-- Name: phase_type; Type: TYPE; Schema: public; Owner: postgres
--

CREATE TYPE public.phase_type AS ENUM (
    'breeding',
    'fattening'
);


ALTER TYPE public.phase_type OWNER TO postgres;

SET default_tablespace = '';

SET default_table_access_method = heap;

--
-- Name: breeding; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.breeding (
    breeding_id integer NOT NULL,
    cage_id integer,
    date_started date,
    date_ended date
);


ALTER TABLE public.breeding OWNER TO postgres;

--
-- Name: breeding_breeding_id_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE public.breeding_breeding_id_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER SEQUENCE public.breeding_breeding_id_seq OWNER TO postgres;

--
-- Name: breeding_breeding_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE public.breeding_breeding_id_seq OWNED BY public.breeding.breeding_id;


--
-- Name: breeding_feed; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.breeding_feed (
    breeding_feed_id integer NOT NULL,
    forage_feed numeric(10,2),
    concentrate_feed numeric(10,2),
    date date,
    concentrate_category_id integer,
    breeding_pan_id integer
);


ALTER TABLE public.breeding_feed OWNER TO postgres;

--
-- Name: breeding_feed_breeding_feed_id_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE public.breeding_feed_breeding_feed_id_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER SEQUENCE public.breeding_feed_breeding_feed_id_seq OWNER TO postgres;

--
-- Name: breeding_feed_breeding_feed_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE public.breeding_feed_breeding_feed_id_seq OWNED BY public.breeding_feed.breeding_feed_id;


--
-- Name: breeding_pan; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.breeding_pan (
    breeding_pan_id integer NOT NULL,
    pan_category_id integer,
    breeding_id integer
);


ALTER TABLE public.breeding_pan OWNER TO postgres;

--
-- Name: breeding_pan_breeding_pan_id_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE public.breeding_pan_breeding_pan_id_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER SEQUENCE public.breeding_pan_breeding_pan_id_seq OWNER TO postgres;

--
-- Name: breeding_pan_breeding_pan_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE public.breeding_pan_breeding_pan_id_seq OWNED BY public.breeding_pan.breeding_pan_id;


--
-- Name: breeding_sheep; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.breeding_sheep (
    breeding_sheep_id integer NOT NULL,
    sheep_id integer,
    breeding_pan_id integer,
    status boolean DEFAULT true
);


ALTER TABLE public.breeding_sheep OWNER TO postgres;

--
-- Name: breeding_sheep_id_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE public.breeding_sheep_id_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER SEQUENCE public.breeding_sheep_id_seq OWNER TO postgres;

--
-- Name: breeding_sheep_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE public.breeding_sheep_id_seq OWNED BY public.breeding_sheep.breeding_sheep_id;


--
-- Name: cache; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.cache (
    key character varying(255) NOT NULL,
    value text NOT NULL,
    expiration integer NOT NULL
);


ALTER TABLE public.cache OWNER TO postgres;

--
-- Name: cache_locks; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.cache_locks (
    key character varying(255) NOT NULL,
    owner character varying(255) NOT NULL,
    expiration integer NOT NULL
);


ALTER TABLE public.cache_locks OWNER TO postgres;

--
-- Name: cage; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.cage (
    cage_id integer NOT NULL,
    mitra_name character varying(100),
    image character varying(255)
);


ALTER TABLE public.cage OWNER TO postgres;

--
-- Name: cage_cage_id_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE public.cage_cage_id_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER SEQUENCE public.cage_cage_id_seq OWNER TO postgres;

--
-- Name: cage_cage_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE public.cage_cage_id_seq OWNED BY public.cage.cage_id;


--
-- Name: cage_pan; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.cage_pan (
    id integer NOT NULL,
    cage_id integer,
    pan_category_id integer
);


ALTER TABLE public.cage_pan OWNER TO postgres;

--
-- Name: cage_pan_id_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE public.cage_pan_id_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER SEQUENCE public.cage_pan_id_seq OWNER TO postgres;

--
-- Name: cage_pan_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE public.cage_pan_id_seq OWNED BY public.cage_pan.id;


--
-- Name: child_category; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.child_category (
    child_category_id integer NOT NULL,
    category_name character varying(50) NOT NULL
);


ALTER TABLE public.child_category OWNER TO postgres;

--
-- Name: child_category_sheep; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.child_category_sheep (
    id integer NOT NULL,
    sheep_id integer NOT NULL,
    child_category_id integer NOT NULL,
    date_started date NOT NULL,
    date_ended date
);


ALTER TABLE public.child_category_sheep OWNER TO postgres;

--
-- Name: child_category_sheep_id_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE public.child_category_sheep_id_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER SEQUENCE public.child_category_sheep_id_seq OWNER TO postgres;

--
-- Name: child_category_sheep_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE public.child_category_sheep_id_seq OWNED BY public.child_category_sheep.id;


--
-- Name: child_status_id_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE public.child_status_id_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER SEQUENCE public.child_status_id_seq OWNER TO postgres;

--
-- Name: child_status_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE public.child_status_id_seq OWNED BY public.child_category.child_category_id;


--
-- Name: concentrate_category; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.concentrate_category (
    concentrate_category_id integer NOT NULL,
    category_name character varying(100) NOT NULL
);


ALTER TABLE public.concentrate_category OWNER TO postgres;

--
-- Name: concentrate_category_id_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE public.concentrate_category_id_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER SEQUENCE public.concentrate_category_id_seq OWNER TO postgres;

--
-- Name: concentrate_category_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE public.concentrate_category_id_seq OWNED BY public.concentrate_category.concentrate_category_id;


--
-- Name: death; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.death (
    death_id integer NOT NULL,
    sheep_id integer,
    date date,
    cause text
);


ALTER TABLE public.death OWNER TO postgres;

--
-- Name: death_death_id_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE public.death_death_id_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER SEQUENCE public.death_death_id_seq OWNER TO postgres;

--
-- Name: death_death_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE public.death_death_id_seq OWNED BY public.death.death_id;


--
-- Name: disease_record; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.disease_record (
    disease_record_id integer NOT NULL,
    sheep_id integer,
    disease_name character varying(100),
    description text,
    treatment text,
    date date
);


ALTER TABLE public.disease_record OWNER TO postgres;

--
-- Name: disease_record_disease_record_id_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE public.disease_record_disease_record_id_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER SEQUENCE public.disease_record_disease_record_id_seq OWNER TO postgres;

--
-- Name: disease_record_disease_record_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE public.disease_record_disease_record_id_seq OWNED BY public.disease_record.disease_record_id;


--
-- Name: failed_jobs; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.failed_jobs (
    id bigint NOT NULL,
    uuid character varying(255) NOT NULL,
    connection text NOT NULL,
    queue text NOT NULL,
    payload text NOT NULL,
    exception text NOT NULL,
    failed_at timestamp(0) without time zone DEFAULT CURRENT_TIMESTAMP NOT NULL
);


ALTER TABLE public.failed_jobs OWNER TO postgres;

--
-- Name: failed_jobs_id_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE public.failed_jobs_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER SEQUENCE public.failed_jobs_id_seq OWNER TO postgres;

--
-- Name: failed_jobs_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE public.failed_jobs_id_seq OWNED BY public.failed_jobs.id;


--
-- Name: fattening; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.fattening (
    fattening_id integer NOT NULL,
    cage_id integer,
    date_started date,
    date_ended date
);


ALTER TABLE public.fattening OWNER TO postgres;

--
-- Name: fattening_fattening_id_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE public.fattening_fattening_id_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER SEQUENCE public.fattening_fattening_id_seq OWNER TO postgres;

--
-- Name: fattening_fattening_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE public.fattening_fattening_id_seq OWNED BY public.fattening.fattening_id;


--
-- Name: fattening_feed; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.fattening_feed (
    fattening_feed_id integer NOT NULL,
    forage_feed numeric(10,2),
    concentrate_feed numeric(10,2),
    date date,
    concentrate_category_id integer,
    fattening_pan_id integer
);


ALTER TABLE public.fattening_feed OWNER TO postgres;

--
-- Name: fattening_feed_fattening_feed_id_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE public.fattening_feed_fattening_feed_id_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER SEQUENCE public.fattening_feed_fattening_feed_id_seq OWNER TO postgres;

--
-- Name: fattening_feed_fattening_feed_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE public.fattening_feed_fattening_feed_id_seq OWNED BY public.fattening_feed.fattening_feed_id;


--
-- Name: fattening_pan; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.fattening_pan (
    fattening_pan_id integer NOT NULL,
    pan_category_id integer,
    fattening_id integer
);


ALTER TABLE public.fattening_pan OWNER TO postgres;

--
-- Name: fattening_pan_fattening_pan_id_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE public.fattening_pan_fattening_pan_id_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER SEQUENCE public.fattening_pan_fattening_pan_id_seq OWNER TO postgres;

--
-- Name: fattening_pan_fattening_pan_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE public.fattening_pan_fattening_pan_id_seq OWNED BY public.fattening_pan.fattening_pan_id;


--
-- Name: fattening_sheep; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.fattening_sheep (
    fattening_sheep_id integer NOT NULL,
    sheep_id integer,
    fattening_pan_id integer,
    status boolean DEFAULT true
);


ALTER TABLE public.fattening_sheep OWNER TO postgres;

--
-- Name: fattening_sheep_id_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE public.fattening_sheep_id_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER SEQUENCE public.fattening_sheep_id_seq OWNER TO postgres;

--
-- Name: fattening_sheep_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE public.fattening_sheep_id_seq OWNED BY public.fattening_sheep.fattening_sheep_id;


--
-- Name: job_batches; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.job_batches (
    id character varying(255) NOT NULL,
    name character varying(255) NOT NULL,
    total_jobs integer NOT NULL,
    pending_jobs integer NOT NULL,
    failed_jobs integer NOT NULL,
    failed_job_ids text NOT NULL,
    options text,
    cancelled_at integer,
    created_at integer NOT NULL,
    finished_at integer
);


ALTER TABLE public.job_batches OWNER TO postgres;

--
-- Name: jobs; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.jobs (
    id bigint NOT NULL,
    queue character varying(255) NOT NULL,
    payload text NOT NULL,
    attempts smallint NOT NULL,
    reserved_at integer,
    available_at integer NOT NULL,
    created_at integer NOT NULL
);


ALTER TABLE public.jobs OWNER TO postgres;

--
-- Name: jobs_id_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE public.jobs_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER SEQUENCE public.jobs_id_seq OWNER TO postgres;

--
-- Name: jobs_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE public.jobs_id_seq OWNED BY public.jobs.id;


--
-- Name: migrations; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.migrations (
    id integer NOT NULL,
    migration character varying(255) NOT NULL,
    batch integer NOT NULL
);


ALTER TABLE public.migrations OWNER TO postgres;

--
-- Name: migrations_id_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE public.migrations_id_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER SEQUENCE public.migrations_id_seq OWNER TO postgres;

--
-- Name: migrations_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE public.migrations_id_seq OWNED BY public.migrations.id;


--
-- Name: pan_category; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.pan_category (
    pan_category_id integer NOT NULL,
    category_name character varying(50) NOT NULL
);


ALTER TABLE public.pan_category OWNER TO postgres;

--
-- Name: pan_category_id_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE public.pan_category_id_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER SEQUENCE public.pan_category_id_seq OWNER TO postgres;

--
-- Name: pan_category_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE public.pan_category_id_seq OWNED BY public.pan_category.pan_category_id;


--
-- Name: password_reset_tokens; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.password_reset_tokens (
    email character varying(255) NOT NULL,
    token character varying(255) NOT NULL,
    created_at timestamp(0) without time zone
);


ALTER TABLE public.password_reset_tokens OWNER TO postgres;

--
-- Name: pregnant; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.pregnant (
    pregnant_id integer NOT NULL,
    date_started date NOT NULL,
    date_ended date,
    sheep_id integer
);


ALTER TABLE public.pregnant OWNER TO postgres;

--
-- Name: pregnant_sheep_pregnant_sheep_id_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE public.pregnant_sheep_pregnant_sheep_id_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER SEQUENCE public.pregnant_sheep_pregnant_sheep_id_seq OWNER TO postgres;

--
-- Name: pregnant_sheep_pregnant_sheep_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE public.pregnant_sheep_pregnant_sheep_id_seq OWNED BY public.pregnant.pregnant_id;


--
-- Name: sessions; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.sessions (
    id character varying(255) NOT NULL,
    user_id bigint,
    ip_address character varying(45),
    user_agent text,
    payload text NOT NULL,
    last_activity integer NOT NULL
);


ALTER TABLE public.sessions OWNER TO postgres;

--
-- Name: sheep; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.sheep (
    sheep_id integer NOT NULL,
    tag_number character varying(50),
    name character varying(100),
    gender character varying(10),
    birth_date date,
    mother_id integer,
    father_id integer,
    pregnant_id integer,
    image character varying(255)
);


ALTER TABLE public.sheep OWNER TO postgres;

--
-- Name: sheep_sheep_id_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE public.sheep_sheep_id_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER SEQUENCE public.sheep_sheep_id_seq OWNER TO postgres;

--
-- Name: sheep_sheep_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE public.sheep_sheep_id_seq OWNED BY public.sheep.sheep_id;


--
-- Name: users; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.users (
    id bigint NOT NULL,
    name character varying(255) NOT NULL,
    email character varying(255) NOT NULL,
    email_verified_at timestamp(0) without time zone,
    password character varying(255) NOT NULL,
    remember_token character varying(100),
    created_at timestamp(0) without time zone,
    updated_at timestamp(0) without time zone
);


ALTER TABLE public.users OWNER TO postgres;

--
-- Name: users_id_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE public.users_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER SEQUENCE public.users_id_seq OWNER TO postgres;

--
-- Name: users_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE public.users_id_seq OWNED BY public.users.id;


--
-- Name: weight_record; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.weight_record (
    weight_record_id integer NOT NULL,
    sheep_id integer,
    weight numeric(10,2),
    date date
);


ALTER TABLE public.weight_record OWNER TO postgres;

--
-- Name: weight_record_weight_record_id_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE public.weight_record_weight_record_id_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER SEQUENCE public.weight_record_weight_record_id_seq OWNER TO postgres;

--
-- Name: weight_record_weight_record_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE public.weight_record_weight_record_id_seq OWNED BY public.weight_record.weight_record_id;


--
-- Name: breeding breeding_id; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.breeding ALTER COLUMN breeding_id SET DEFAULT nextval('public.breeding_breeding_id_seq'::regclass);


--
-- Name: breeding_feed breeding_feed_id; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.breeding_feed ALTER COLUMN breeding_feed_id SET DEFAULT nextval('public.breeding_feed_breeding_feed_id_seq'::regclass);


--
-- Name: breeding_pan breeding_pan_id; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.breeding_pan ALTER COLUMN breeding_pan_id SET DEFAULT nextval('public.breeding_pan_breeding_pan_id_seq'::regclass);


--
-- Name: breeding_sheep breeding_sheep_id; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.breeding_sheep ALTER COLUMN breeding_sheep_id SET DEFAULT nextval('public.breeding_sheep_id_seq'::regclass);


--
-- Name: cage cage_id; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.cage ALTER COLUMN cage_id SET DEFAULT nextval('public.cage_cage_id_seq'::regclass);


--
-- Name: cage_pan id; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.cage_pan ALTER COLUMN id SET DEFAULT nextval('public.cage_pan_id_seq'::regclass);


--
-- Name: child_category child_category_id; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.child_category ALTER COLUMN child_category_id SET DEFAULT nextval('public.child_status_id_seq'::regclass);


--
-- Name: child_category_sheep id; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.child_category_sheep ALTER COLUMN id SET DEFAULT nextval('public.child_category_sheep_id_seq'::regclass);


--
-- Name: concentrate_category concentrate_category_id; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.concentrate_category ALTER COLUMN concentrate_category_id SET DEFAULT nextval('public.concentrate_category_id_seq'::regclass);


--
-- Name: death death_id; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.death ALTER COLUMN death_id SET DEFAULT nextval('public.death_death_id_seq'::regclass);


--
-- Name: disease_record disease_record_id; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.disease_record ALTER COLUMN disease_record_id SET DEFAULT nextval('public.disease_record_disease_record_id_seq'::regclass);


--
-- Name: failed_jobs id; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.failed_jobs ALTER COLUMN id SET DEFAULT nextval('public.failed_jobs_id_seq'::regclass);


--
-- Name: fattening fattening_id; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.fattening ALTER COLUMN fattening_id SET DEFAULT nextval('public.fattening_fattening_id_seq'::regclass);


--
-- Name: fattening_feed fattening_feed_id; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.fattening_feed ALTER COLUMN fattening_feed_id SET DEFAULT nextval('public.fattening_feed_fattening_feed_id_seq'::regclass);


--
-- Name: fattening_pan fattening_pan_id; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.fattening_pan ALTER COLUMN fattening_pan_id SET DEFAULT nextval('public.fattening_pan_fattening_pan_id_seq'::regclass);


--
-- Name: fattening_sheep fattening_sheep_id; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.fattening_sheep ALTER COLUMN fattening_sheep_id SET DEFAULT nextval('public.fattening_sheep_id_seq'::regclass);


--
-- Name: jobs id; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.jobs ALTER COLUMN id SET DEFAULT nextval('public.jobs_id_seq'::regclass);


--
-- Name: migrations id; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.migrations ALTER COLUMN id SET DEFAULT nextval('public.migrations_id_seq'::regclass);


--
-- Name: pan_category pan_category_id; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.pan_category ALTER COLUMN pan_category_id SET DEFAULT nextval('public.pan_category_id_seq'::regclass);


--
-- Name: pregnant pregnant_id; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.pregnant ALTER COLUMN pregnant_id SET DEFAULT nextval('public.pregnant_sheep_pregnant_sheep_id_seq'::regclass);


--
-- Name: sheep sheep_id; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.sheep ALTER COLUMN sheep_id SET DEFAULT nextval('public.sheep_sheep_id_seq'::regclass);


--
-- Name: users id; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.users ALTER COLUMN id SET DEFAULT nextval('public.users_id_seq'::regclass);


--
-- Name: weight_record weight_record_id; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.weight_record ALTER COLUMN weight_record_id SET DEFAULT nextval('public.weight_record_weight_record_id_seq'::regclass);


--
-- Name: breeding_feed breeding_feed_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.breeding_feed
    ADD CONSTRAINT breeding_feed_pkey PRIMARY KEY (breeding_feed_id);


--
-- Name: breeding_pan breeding_pan_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.breeding_pan
    ADD CONSTRAINT breeding_pan_pkey PRIMARY KEY (breeding_pan_id);


--
-- Name: breeding breeding_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.breeding
    ADD CONSTRAINT breeding_pkey PRIMARY KEY (breeding_id);


--
-- Name: breeding_sheep breeding_sheep_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.breeding_sheep
    ADD CONSTRAINT breeding_sheep_pkey PRIMARY KEY (breeding_sheep_id);


--
-- Name: cache_locks cache_locks_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.cache_locks
    ADD CONSTRAINT cache_locks_pkey PRIMARY KEY (key);


--
-- Name: cache cache_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.cache
    ADD CONSTRAINT cache_pkey PRIMARY KEY (key);


--
-- Name: cage_pan cage_pan_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.cage_pan
    ADD CONSTRAINT cage_pan_pkey PRIMARY KEY (id);


--
-- Name: cage cage_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.cage
    ADD CONSTRAINT cage_pkey PRIMARY KEY (cage_id);


--
-- Name: child_category_sheep child_category_sheep_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.child_category_sheep
    ADD CONSTRAINT child_category_sheep_pkey PRIMARY KEY (id);


--
-- Name: child_category child_status_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.child_category
    ADD CONSTRAINT child_status_pkey PRIMARY KEY (child_category_id);


--
-- Name: concentrate_category concentrate_category_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.concentrate_category
    ADD CONSTRAINT concentrate_category_pkey PRIMARY KEY (concentrate_category_id);


--
-- Name: death death_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.death
    ADD CONSTRAINT death_pkey PRIMARY KEY (death_id);


--
-- Name: disease_record disease_record_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.disease_record
    ADD CONSTRAINT disease_record_pkey PRIMARY KEY (disease_record_id);


--
-- Name: failed_jobs failed_jobs_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.failed_jobs
    ADD CONSTRAINT failed_jobs_pkey PRIMARY KEY (id);


--
-- Name: failed_jobs failed_jobs_uuid_unique; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.failed_jobs
    ADD CONSTRAINT failed_jobs_uuid_unique UNIQUE (uuid);


--
-- Name: fattening_feed fattening_feed_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.fattening_feed
    ADD CONSTRAINT fattening_feed_pkey PRIMARY KEY (fattening_feed_id);


--
-- Name: fattening_pan fattening_pan_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.fattening_pan
    ADD CONSTRAINT fattening_pan_pkey PRIMARY KEY (fattening_pan_id);


--
-- Name: fattening fattening_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.fattening
    ADD CONSTRAINT fattening_pkey PRIMARY KEY (fattening_id);


--
-- Name: fattening_sheep fattening_sheep_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.fattening_sheep
    ADD CONSTRAINT fattening_sheep_pkey PRIMARY KEY (fattening_sheep_id);


--
-- Name: job_batches job_batches_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.job_batches
    ADD CONSTRAINT job_batches_pkey PRIMARY KEY (id);


--
-- Name: jobs jobs_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.jobs
    ADD CONSTRAINT jobs_pkey PRIMARY KEY (id);


--
-- Name: migrations migrations_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.migrations
    ADD CONSTRAINT migrations_pkey PRIMARY KEY (id);


--
-- Name: pan_category pan_category_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.pan_category
    ADD CONSTRAINT pan_category_pkey PRIMARY KEY (pan_category_id);


--
-- Name: password_reset_tokens password_reset_tokens_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.password_reset_tokens
    ADD CONSTRAINT password_reset_tokens_pkey PRIMARY KEY (email);


--
-- Name: pregnant pregnant_sheep_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.pregnant
    ADD CONSTRAINT pregnant_sheep_pkey PRIMARY KEY (pregnant_id);


--
-- Name: sessions sessions_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.sessions
    ADD CONSTRAINT sessions_pkey PRIMARY KEY (id);


--
-- Name: sheep sheep_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.sheep
    ADD CONSTRAINT sheep_pkey PRIMARY KEY (sheep_id);


--
-- Name: users users_email_unique; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.users
    ADD CONSTRAINT users_email_unique UNIQUE (email);


--
-- Name: users users_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.users
    ADD CONSTRAINT users_pkey PRIMARY KEY (id);


--
-- Name: weight_record weight_record_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.weight_record
    ADD CONSTRAINT weight_record_pkey PRIMARY KEY (weight_record_id);


--
-- Name: jobs_queue_index; Type: INDEX; Schema: public; Owner: postgres
--

CREATE INDEX jobs_queue_index ON public.jobs USING btree (queue);


--
-- Name: sessions_last_activity_index; Type: INDEX; Schema: public; Owner: postgres
--

CREATE INDEX sessions_last_activity_index ON public.sessions USING btree (last_activity);


--
-- Name: sessions_user_id_index; Type: INDEX; Schema: public; Owner: postgres
--

CREATE INDEX sessions_user_id_index ON public.sessions USING btree (user_id);


--
-- Name: breeding breeding_cage_id_fkey; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.breeding
    ADD CONSTRAINT breeding_cage_id_fkey FOREIGN KEY (cage_id) REFERENCES public.cage(cage_id);


--
-- Name: breeding_pan breeding_pan_breeding_id_fkey; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.breeding_pan
    ADD CONSTRAINT breeding_pan_breeding_id_fkey FOREIGN KEY (breeding_id) REFERENCES public.breeding(breeding_id);


--
-- Name: breeding_pan breeding_pan_pan_category_id_fkey; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.breeding_pan
    ADD CONSTRAINT breeding_pan_pan_category_id_fkey FOREIGN KEY (pan_category_id) REFERENCES public.pan_category(pan_category_id);


--
-- Name: breeding_sheep breeding_sheep_sheep_id_fkey; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.breeding_sheep
    ADD CONSTRAINT breeding_sheep_sheep_id_fkey FOREIGN KEY (sheep_id) REFERENCES public.sheep(sheep_id) ON DELETE CASCADE;


--
-- Name: cage_pan cage_pan_cage_id_fkey; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.cage_pan
    ADD CONSTRAINT cage_pan_cage_id_fkey FOREIGN KEY (cage_id) REFERENCES public.cage(cage_id) ON DELETE CASCADE;


--
-- Name: cage_pan cage_pan_pan_id_fkey; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.cage_pan
    ADD CONSTRAINT cage_pan_pan_id_fkey FOREIGN KEY (pan_category_id) REFERENCES public.pan_category(pan_category_id) ON DELETE CASCADE;


--
-- Name: child_category_sheep child_category_sheep_child_category_id_fkey; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.child_category_sheep
    ADD CONSTRAINT child_category_sheep_child_category_id_fkey FOREIGN KEY (child_category_id) REFERENCES public.child_category(child_category_id) ON DELETE CASCADE;


--
-- Name: child_category_sheep child_category_sheep_sheep_id_fkey; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.child_category_sheep
    ADD CONSTRAINT child_category_sheep_sheep_id_fkey FOREIGN KEY (sheep_id) REFERENCES public.sheep(sheep_id) ON DELETE CASCADE;


--
-- Name: death death_sheep_id_fkey; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.death
    ADD CONSTRAINT death_sheep_id_fkey FOREIGN KEY (sheep_id) REFERENCES public.sheep(sheep_id);


--
-- Name: disease_record disease_record_sheep_id_fkey; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.disease_record
    ADD CONSTRAINT disease_record_sheep_id_fkey FOREIGN KEY (sheep_id) REFERENCES public.sheep(sheep_id);


--
-- Name: fattening fattening_cage_id_fkey; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.fattening
    ADD CONSTRAINT fattening_cage_id_fkey FOREIGN KEY (cage_id) REFERENCES public.cage(cage_id);


--
-- Name: fattening_pan fattening_pan_fattening_id_fkey; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.fattening_pan
    ADD CONSTRAINT fattening_pan_fattening_id_fkey FOREIGN KEY (fattening_id) REFERENCES public.fattening(fattening_id);


--
-- Name: fattening_pan fattening_pan_pan_category_id_fkey; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.fattening_pan
    ADD CONSTRAINT fattening_pan_pan_category_id_fkey FOREIGN KEY (pan_category_id) REFERENCES public.pan_category(pan_category_id);


--
-- Name: fattening_sheep fattening_sheep_sheep_id_fkey; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.fattening_sheep
    ADD CONSTRAINT fattening_sheep_sheep_id_fkey FOREIGN KEY (sheep_id) REFERENCES public.sheep(sheep_id) ON DELETE CASCADE;


--
-- Name: breeding_feed fk_breeding_feed_breeding_pan; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.breeding_feed
    ADD CONSTRAINT fk_breeding_feed_breeding_pan FOREIGN KEY (breeding_pan_id) REFERENCES public.breeding_pan(breeding_pan_id) ON DELETE CASCADE;


--
-- Name: breeding_sheep fk_breeding_sheep_breeding_pan; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.breeding_sheep
    ADD CONSTRAINT fk_breeding_sheep_breeding_pan FOREIGN KEY (breeding_pan_id) REFERENCES public.breeding_pan(breeding_pan_id) ON DELETE CASCADE;


--
-- Name: breeding_feed fk_concentrate_category; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.breeding_feed
    ADD CONSTRAINT fk_concentrate_category FOREIGN KEY (concentrate_category_id) REFERENCES public.concentrate_category(concentrate_category_id);


--
-- Name: fattening_feed fk_concentrate_category; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.fattening_feed
    ADD CONSTRAINT fk_concentrate_category FOREIGN KEY (concentrate_category_id) REFERENCES public.concentrate_category(concentrate_category_id);


--
-- Name: sheep fk_father; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.sheep
    ADD CONSTRAINT fk_father FOREIGN KEY (father_id) REFERENCES public.sheep(sheep_id);


--
-- Name: fattening_sheep fk_fattening_pan; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.fattening_sheep
    ADD CONSTRAINT fk_fattening_pan FOREIGN KEY (fattening_pan_id) REFERENCES public.fattening_pan(fattening_pan_id);


--
-- Name: fattening_feed fk_fattening_pan; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.fattening_feed
    ADD CONSTRAINT fk_fattening_pan FOREIGN KEY (fattening_pan_id) REFERENCES public.fattening_pan(fattening_pan_id);


--
-- Name: sheep fk_mother; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.sheep
    ADD CONSTRAINT fk_mother FOREIGN KEY (mother_id) REFERENCES public.sheep(sheep_id);


--
-- Name: sheep fk_pregnant_sheep; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.sheep
    ADD CONSTRAINT fk_pregnant_sheep FOREIGN KEY (pregnant_id) REFERENCES public.pregnant(pregnant_id) ON DELETE SET NULL;


--
-- Name: pregnant fk_pregnant_sheep; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.pregnant
    ADD CONSTRAINT fk_pregnant_sheep FOREIGN KEY (sheep_id) REFERENCES public.sheep(sheep_id) ON DELETE CASCADE;


--
-- Name: weight_record weight_record_sheep_id_fkey; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.weight_record
    ADD CONSTRAINT weight_record_sheep_id_fkey FOREIGN KEY (sheep_id) REFERENCES public.sheep(sheep_id);


--
-- PostgreSQL database dump complete
--

