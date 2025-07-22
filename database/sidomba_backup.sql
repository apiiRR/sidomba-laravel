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
-- Data for Name: breeding; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY public.breeding (breeding_id, cage_id, date_started, date_ended) FROM stdin;
1	1	2025-06-01	2025-06-30
2	2	2025-07-05	2025-08-04
\.


--
-- Data for Name: breeding_feed; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY public.breeding_feed (breeding_feed_id, forage_feed, concentrate_feed, date, concentrate_category_id, breeding_pan_id) FROM stdin;
1	5000.00	1500.00	2025-06-02	1	1
2	4500.00	1700.00	2025-06-10	4	1
3	5200.00	1200.00	2025-06-15	3	2
4	6000.00	1800.00	2025-07-06	1	3
5	5800.00	2000.00	2025-07-12	5	3
6	4000.00	1300.00	2025-07-15	2	4
\.


--
-- Data for Name: breeding_pan; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY public.breeding_pan (breeding_pan_id, pan_category_id, breeding_id) FROM stdin;
1	1	1
2	3	1
3	1	2
4	2	2
\.


--
-- Data for Name: breeding_sheep; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY public.breeding_sheep (breeding_sheep_id, sheep_id, breeding_pan_id, status) FROM stdin;
1	3	1	t
2	1	1	t
3	2	1	t
4	1	2	t
5	2	2	t
6	8	3	t
7	5	3	t
8	6	3	t
9	5	4	t
10	6	4	t
\.


--
-- Data for Name: cache; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY public.cache (key, value, expiration) FROM stdin;
\.


--
-- Data for Name: cache_locks; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY public.cache_locks (key, owner, expiration) FROM stdin;
\.


--
-- Data for Name: cage; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY public.cage (cage_id, mitra_name, image) FROM stdin;
1	Pak Budi	\N
2	Bu Sari	\N
3	Pak Joko	\N
4	Bu Rina	\N
5	Pak Roni	\N
6	Bu Lilis	\N
7	Pak Dede	\N
8	Bu Eni	\N
9	Pak Arif	\N
10	Bu Wati	\N
\.


--
-- Data for Name: cage_pan; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY public.cage_pan (id, cage_id, pan_category_id) FROM stdin;
1	1	1
2	1	2
3	2	3
4	2	4
5	3	5
6	3	6
7	4	7
8	5	8
9	6	9
10	7	10
11	9	4
12	10	4
\.


--
-- Data for Name: child_category; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY public.child_category (child_category_id, category_name) FROM stdin;
1	Menyusui
2	Lepas Sapih
3	Siap Penggemukan
\.


--
-- Data for Name: child_category_sheep; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY public.child_category_sheep (id, sheep_id, child_category_id, date_started, date_ended) FROM stdin;
1	3	1	2025-06-12	2025-07-12
2	3	2	2025-07-13	2025-08-13
3	3	3	2025-08-14	\N
4	4	1	2025-06-12	2025-07-20
5	4	2	2025-07-21	\N
6	5	1	2025-07-08	\N
7	6	1	2025-07-08	2025-08-08
8	6	2	2025-08-09	\N
9	8	3	2025-06-01	\N
10	10	2	2025-06-15	\N
\.


--
-- Data for Name: concentrate_category; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY public.concentrate_category (concentrate_category_id, category_name) FROM stdin;
1	Starter
2	Grower
3	Finisher
4	Laktasi
5	Breeding
6	Penggemukan Intensif
7	Pemulihan
8	Maintenance
9	Persiapan Kawin
10	Pasca Sapih
\.


--
-- Data for Name: death; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY public.death (death_id, sheep_id, date, cause) FROM stdin;
\.


--
-- Data for Name: disease_record; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY public.disease_record (disease_record_id, sheep_id, disease_name, description, treatment, date) FROM stdin;
\.


--
-- Data for Name: failed_jobs; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY public.failed_jobs (id, uuid, connection, queue, payload, exception, failed_at) FROM stdin;
\.


--
-- Data for Name: fattening; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY public.fattening (fattening_id, cage_id, date_started, date_ended) FROM stdin;
1	9	2025-07-01	2025-08-01
2	10	2025-08-05	2025-09-05
\.


--
-- Data for Name: fattening_feed; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY public.fattening_feed (fattening_feed_id, forage_feed, concentrate_feed, date, concentrate_category_id, fattening_pan_id) FROM stdin;
1	4500.00	1200.00	2025-07-03	3	1
2	4600.00	1300.00	2025-07-10	3	1
3	4800.00	1400.00	2025-08-07	3	2
4	4700.00	1500.00	2025-08-14	3	2
\.


--
-- Data for Name: fattening_pan; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY public.fattening_pan (fattening_pan_id, pan_category_id, fattening_id) FROM stdin;
1	4	1
2	4	2
\.


--
-- Data for Name: fattening_sheep; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY public.fattening_sheep (fattening_sheep_id, sheep_id, fattening_pan_id, status) FROM stdin;
1	3	1	t
2	4	1	t
3	5	2	t
4	6	2	t
\.


--
-- Data for Name: job_batches; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY public.job_batches (id, name, total_jobs, pending_jobs, failed_jobs, failed_job_ids, options, cancelled_at, created_at, finished_at) FROM stdin;
\.


--
-- Data for Name: jobs; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY public.jobs (id, queue, payload, attempts, reserved_at, available_at, created_at) FROM stdin;
\.


--
-- Data for Name: migrations; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY public.migrations (id, migration, batch) FROM stdin;
1	0001_01_01_000000_create_users_table	1
2	0001_01_01_000001_create_cache_table	1
3	0001_01_01_000002_create_jobs_table	1
\.


--
-- Data for Name: pan_category; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY public.pan_category (pan_category_id, category_name) FROM stdin;
1	Kawin
2	Menyusui
3	Bunting
4	Penggemukan
5	Lepas Sapih
6	Isolasi
7	Perawatan
8	Karantina
9	Induk Kosong
10	Jantan Dewasa
\.


--
-- Data for Name: password_reset_tokens; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY public.password_reset_tokens (email, token, created_at) FROM stdin;
\.


--
-- Data for Name: pregnant; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY public.pregnant (pregnant_id, date_started, date_ended, sheep_id) FROM stdin;
1	2025-01-10	2025-06-10	1
2	2025-02-05	2025-07-05	2
\.


--
-- Data for Name: sessions; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY public.sessions (id, user_id, ip_address, user_agent, payload, last_activity) FROM stdin;
uQan6TIowJvavoMeQtguZR03JdHkAX3Xt2P0Sk6j	\N	127.0.0.1	Mozilla/5.0 (Macintosh; Intel Mac OS X 10_15_7) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/138.0.0.0 Safari/537.36	YTo0OntzOjY6Il90b2tlbiI7czo0MDoiNzdJUzZ4SUxPcEM3Y3l6RTY2S0w4Z2tJYWNVd1hHVkFIMm51STBJTCI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6NDg6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMC9icmVlZGluZy90cmFuc2ZlclNoZWVwLzcvMiI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fXM6NToiYWxlcnQiO2E6MDp7fX0=	1752740749
\.


--
-- Data for Name: sheep; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY public.sheep (sheep_id, tag_number, name, gender, birth_date, mother_id, father_id, pregnant_id, image) FROM stdin;
3	A003	Anak A1	Jantan	2025-06-12	1	\N	1	\N
6	A006	Anak B2	Jantan	2025-07-08	2	\N	2	\N
8	A008	Anak C1	Jantan	2025-03-01	7	\N	\N	\N
2	A002	Induk B	Betina	2022-06-20	\N	\N	\N	\N
4	A004	Anak A2	Betina	2025-06-12	1	\N	1	\N
5	A005	Anak B1	Betina	2025-07-08	2	\N	2	\N
7	A007	Induk C	Betina	2021-09-15	\N	\N	\N	\N
9	A009	Induk D	Betina	2021-11-23	\N	\N	\N	\N
10	A010	Anak D1	Betina	2025-04-15	9	\N	\N	\N
1	A001	Induk A	Betina	2022-05-10	\N	\N	\N	IHRLJZZdqM8wlTQYNwl66EukfVO0xKqk6mTbd5Bh.png
\.


--
-- Data for Name: users; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY public.users (id, name, email, email_verified_at, password, remember_token, created_at, updated_at) FROM stdin;
\.


--
-- Data for Name: weight_record; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY public.weight_record (weight_record_id, sheep_id, weight, date) FROM stdin;
1	1	45.00	2025-06-01
2	2	43.50	2025-06-01
3	3	5.20	2025-06-13
4	3	8.40	2025-07-20
5	3	12.00	2025-09-01
6	4	5.00	2025-06-13
7	5	4.70	2025-07-10
8	6	4.90	2025-07-11
9	8	15.00	2025-07-01
10	10	13.00	2025-07-01
\.


--
-- Name: breeding_breeding_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('public.breeding_breeding_id_seq', 8, true);


--
-- Name: breeding_feed_breeding_feed_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('public.breeding_feed_breeding_feed_id_seq', 8, true);


--
-- Name: breeding_pan_breeding_pan_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('public.breeding_pan_breeding_pan_id_seq', 2, true);


--
-- Name: breeding_sheep_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('public.breeding_sheep_id_seq', 10, true);


--
-- Name: cage_cage_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('public.cage_cage_id_seq', 10, true);


--
-- Name: cage_pan_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('public.cage_pan_id_seq', 3, true);


--
-- Name: child_category_sheep_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('public.child_category_sheep_id_seq', 1, true);


--
-- Name: child_status_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('public.child_status_id_seq', 2, true);


--
-- Name: concentrate_category_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('public.concentrate_category_id_seq', 3, true);


--
-- Name: death_death_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('public.death_death_id_seq', 3, true);


--
-- Name: disease_record_disease_record_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('public.disease_record_disease_record_id_seq', 6, true);


--
-- Name: failed_jobs_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('public.failed_jobs_id_seq', 1, false);


--
-- Name: fattening_fattening_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('public.fattening_fattening_id_seq', 8, true);


--
-- Name: fattening_feed_fattening_feed_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('public.fattening_feed_fattening_feed_id_seq', 8, true);


--
-- Name: fattening_pan_fattening_pan_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('public.fattening_pan_fattening_pan_id_seq', 1, false);


--
-- Name: fattening_sheep_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('public.fattening_sheep_id_seq', 1, false);


--
-- Name: jobs_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('public.jobs_id_seq', 1, false);


--
-- Name: migrations_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('public.migrations_id_seq', 3, true);


--
-- Name: pan_category_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('public.pan_category_id_seq', 7, true);


--
-- Name: pregnant_sheep_pregnant_sheep_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('public.pregnant_sheep_pregnant_sheep_id_seq', 1, false);


--
-- Name: sheep_sheep_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('public.sheep_sheep_id_seq', 16, true);


--
-- Name: users_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('public.users_id_seq', 1, false);


--
-- Name: weight_record_weight_record_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('public.weight_record_weight_record_id_seq', 12, true);


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

