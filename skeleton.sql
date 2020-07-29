--
-- PostgreSQL database dump
--

-- Dumped from database version 12.1
-- Dumped by pg_dump version 12.1

SET statement_timeout = 0;
SET lock_timeout = 0;
SET idle_in_transaction_session_timeout = 0;
SET client_encoding = 'UTF8';
SET standard_conforming_strings = on;
SELECT pg_catalog.set_config('search_path', '', false);
SET check_function_bodies = false;
SET xmloption = content;
SET client_min_messages = warning;
SET row_security = off;

SET default_tablespace = '';

SET default_table_access_method = heap;

--
-- Name: ci_sessions; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.ci_sessions (
    id character varying(128) NOT NULL,
    ip_address character varying(45) NOT NULL,
    "timestamp" bigint DEFAULT 0 NOT NULL,
    data text DEFAULT ''::text NOT NULL
);


ALTER TABLE public.ci_sessions OWNER TO postgres;

--
-- Name: courses; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.courses (
    name character varying(255) NOT NULL,
    id integer NOT NULL
);


ALTER TABLE public.courses OWNER TO postgres;

--
-- Name: courses_id_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE public.courses_id_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.courses_id_seq OWNER TO postgres;

--
-- Name: courses_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE public.courses_id_seq OWNED BY public.courses.id;


--
-- Name: dept; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.dept (
    dname character varying(255),
    id integer NOT NULL
);


ALTER TABLE public.dept OWNER TO postgres;

--
-- Name: dept_id_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE public.dept_id_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.dept_id_seq OWNER TO postgres;

--
-- Name: dept_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE public.dept_id_seq OWNED BY public.dept.id;


--
-- Name: depttrainings; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.depttrainings (
    trainingid integer,
    dname integer,
    id integer NOT NULL,
    directorate integer,
    district integer,
    spoffice integer
);


ALTER TABLE public.depttrainings OWNER TO postgres;

--
-- Name: depttrainings_id_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE public.depttrainings_id_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.depttrainings_id_seq OWNER TO postgres;

--
-- Name: depttrainings_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE public.depttrainings_id_seq OWNED BY public.depttrainings.id;


--
-- Name: designation; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.designation (
    name character varying(255) NOT NULL,
    id integer NOT NULL
);


ALTER TABLE public.designation OWNER TO postgres;

--
-- Name: designation_id_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE public.designation_id_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.designation_id_seq OWNER TO postgres;

--
-- Name: designation_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE public.designation_id_seq OWNED BY public.designation.id;


--
-- Name: directorate; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.directorate (
    id integer NOT NULL,
    name character varying(255),
    dept integer
);


ALTER TABLE public.directorate OWNER TO postgres;

--
-- Name: directorate_id_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE public.directorate_id_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.directorate_id_seq OWNER TO postgres;

--
-- Name: directorate_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE public.directorate_id_seq OWNED BY public.directorate.id;


--
-- Name: district; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.district (
    id integer NOT NULL,
    name character varying(255)
);


ALTER TABLE public.district OWNER TO postgres;

--
-- Name: district_id_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE public.district_id_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.district_id_seq OWNER TO postgres;

--
-- Name: district_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE public.district_id_seq OWNED BY public.district.id;


--
-- Name: emd1; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.emd1 (
    id integer NOT NULL,
    name character varying(255),
    email character varying(255),
    designation character varying,
    files character varying(255),
    dept integer,
    type character varying(255),
    directorate integer,
    district integer,
    spoffice integer
);


ALTER TABLE public.emd1 OWNER TO postgres;

--
-- Name: emd1_id_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE public.emd1_id_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.emd1_id_seq OWNER TO postgres;

--
-- Name: emd1_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE public.emd1_id_seq OWNED BY public.emd1.id;


--
-- Name: employee; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.employee (
    name character varying(255) NOT NULL,
    email character varying(255) NOT NULL,
    phone character varying(10) NOT NULL,
    role character varying(255),
    password character varying(512),
    status character varying(255),
    rs character varying(1222),
    session_id character varying(50),
    designation character varying(255),
    dept integer,
    directorate integer,
    id integer NOT NULL,
    spoffice integer,
    district integer,
    office character varying(255)
);


ALTER TABLE public.employee OWNER TO postgres;

--
-- Name: employee_id_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE public.employee_id_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.employee_id_seq OWNER TO postgres;

--
-- Name: employee_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE public.employee_id_seq OWNED BY public.employee.id;


--
-- Name: files; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.files (
    organisation character varying(255),
    value1 integer,
    value2 integer,
    value3 integer,
    value4 integer,
    value5 integer,
    id integer NOT NULL,
    dept integer,
    directorate integer,
    district integer,
    spoffice integer,
    live date
);


ALTER TABLE public.files OWNER TO postgres;

--
-- Name: files_id_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE public.files_id_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.files_id_seq OWNER TO postgres;

--
-- Name: files_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE public.files_id_seq OWNED BY public.files.id;


--
-- Name: infradirectorate; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.infradirectorate (
    total_users character varying(255),
    users_system character varying(255),
    new_system character varying(255),
    dsc character varying(255),
    scanners character varying(255),
    printers character varying(255),
    dsc_required character varying(255),
    printer_required character varying(255),
    scanners_required character varying(255),
    system_required character varying(255),
    isp character varying(255),
    bandwidth character varying(255),
    cabling character varying(255),
    id integer NOT NULL,
    dept integer,
    directorate integer,
    district integer,
    spoffice integer
);


ALTER TABLE public.infradirectorate OWNER TO postgres;

--
-- Name: infradirectorate_id_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE public.infradirectorate_id_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.infradirectorate_id_seq OWNER TO postgres;

--
-- Name: infradirectorate_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE public.infradirectorate_id_seq OWNED BY public.infradirectorate.id;


--
-- Name: infradistrict; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.infradistrict (
    total_users character varying(255),
    users_system character varying(255),
    new_system character varying(255),
    dsc character varying(255),
    scanners character varying(255),
    printers character varying(255),
    dsc_required character varying(255),
    printer_required character varying(255),
    scanners_required character varying(255),
    system_required character varying(255),
    isp character varying(255),
    bandwidth character varying(255),
    cabling character varying(255),
    district integer,
    id integer NOT NULL
);


ALTER TABLE public.infradistrict OWNER TO postgres;

--
-- Name: infradistrict_id_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE public.infradistrict_id_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.infradistrict_id_seq OWNER TO postgres;

--
-- Name: infradistrict_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE public.infradistrict_id_seq OWNED BY public.infradistrict.id;


--
-- Name: infrasecretariat; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.infrasecretariat (
    total_users character varying(255),
    users_system character varying(255),
    new_system character varying(255),
    dsc character varying(255),
    scanners character varying(255),
    printers character varying(255),
    dsc_required character varying(255),
    printer_required character varying(255),
    scanners_required character varying(255),
    system_required character varying(255),
    isp character varying(255),
    bandwidth character varying(255),
    cabling character varying(255),
    id integer NOT NULL,
    directorate integer,
    district integer,
    dept integer
);


ALTER TABLE public.infrasecretariat OWNER TO postgres;

--
-- Name: infrasecretariat_id_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE public.infrasecretariat_id_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.infrasecretariat_id_seq OWNER TO postgres;

--
-- Name: infrasecretariat_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE public.infrasecretariat_id_seq OWNED BY public.infrasecretariat.id;


--
-- Name: nodaldistrict; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.nodaldistrict (
    id integer NOT NULL,
    n_name character varying(255),
    m_name character varying(255),
    e_name character varying(255),
    district integer,
    designation character varying(255),
    email character varying(255),
    phone character varying(255)
);


ALTER TABLE public.nodaldistrict OWNER TO postgres;

--
-- Name: nodaldistrict_id_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE public.nodaldistrict_id_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.nodaldistrict_id_seq OWNER TO postgres;

--
-- Name: nodaldistrict_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE public.nodaldistrict_id_seq OWNED BY public.nodaldistrict.id;


--
-- Name: participanttype; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.participanttype (
    name character varying(255) NOT NULL
);


ALTER TABLE public.participanttype OWNER TO postgres;

--
-- Name: participation; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.participation (
    name character varying(255),
    trainingsid integer,
    email character varying(255),
    phone character varying(255),
    dept integer,
    id integer NOT NULL,
    designation character varying(255),
    type character varying(255),
    dname character varying(255),
    spoffice character varying(255),
    directorate character varying(255),
    district character varying(255),
    direct integer,
    dist integer,
    spofc integer
);


ALTER TABLE public.participation OWNER TO postgres;

--
-- Name: participation_id_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE public.participation_id_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.participation_id_seq OWNER TO postgres;

--
-- Name: participation_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE public.participation_id_seq OWNED BY public.participation.id;


--
-- Name: receipts; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.receipts (
    id integer NOT NULL,
    organisation character varying(255),
    value1 character varying(255),
    value2 character varying(255),
    value3 character varying(255),
    value4 character varying(255),
    value5 character varying(255),
    dept integer,
    directorate integer,
    district integer,
    spoffice integer,
    live date
);


ALTER TABLE public.receipts OWNER TO postgres;

--
-- Name: receipts_id_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE public.receipts_id_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.receipts_id_seq OWNER TO postgres;

--
-- Name: receipts_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE public.receipts_id_seq OWNED BY public.receipts.id;


--
-- Name: report; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.report (
    live date,
    filescreated integer,
    filesmoved integer,
    receiptscreated integer,
    receiptsmoved integer,
    id integer NOT NULL,
    dept integer,
    directorate integer,
    district integer,
    spoffice integer
);


ALTER TABLE public.report OWNER TO postgres;

--
-- Name: report_id_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE public.report_id_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.report_id_seq OWNER TO postgres;

--
-- Name: report_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE public.report_id_seq OWNED BY public.report.id;


--
-- Name: role; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.role (
    name character varying(255) NOT NULL
);


ALTER TABLE public.role OWNER TO postgres;

--
-- Name: secretariat; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.secretariat (
    n_name character varying(255),
    e_name character varying(255),
    m_name character varying(255),
    id integer NOT NULL,
    dept integer,
    directorate integer,
    designation character varying(255),
    phone character varying(10),
    email character varying(255)
);


ALTER TABLE public.secretariat OWNER TO postgres;

--
-- Name: secretariat_id_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE public.secretariat_id_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.secretariat_id_seq OWNER TO postgres;

--
-- Name: secretariat_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE public.secretariat_id_seq OWNED BY public.secretariat.id;


--
-- Name: spoffice; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.spoffice (
    id integer NOT NULL,
    name character varying(255)
);


ALTER TABLE public.spoffice OWNER TO postgres;

--
-- Name: spoffice_id_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE public.spoffice_id_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.spoffice_id_seq OWNER TO postgres;

--
-- Name: spoffice_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE public.spoffice_id_seq OWNED BY public.spoffice.id;


--
-- Name: trainings; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.trainings (
    id integer NOT NULL,
    title character varying(255),
    starting timestamp without time zone,
    course integer,
    venue integer,
    files character varying(255),
    type character varying(255),
    ending timestamp without time zone
);


ALTER TABLE public.trainings OWNER TO postgres;

--
-- Name: trainings_id_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE public.trainings_id_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.trainings_id_seq OWNER TO postgres;

--
-- Name: trainings_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE public.trainings_id_seq OWNED BY public.trainings.id;


--
-- Name: trainingtype; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.trainingtype (
    name character varying(255) NOT NULL
);


ALTER TABLE public.trainingtype OWNER TO postgres;

--
-- Name: type; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.type (
    name character varying(255) NOT NULL
);


ALTER TABLE public.type OWNER TO postgres;

--
-- Name: venue; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.venue (
    id integer NOT NULL,
    name character varying(255)
);


ALTER TABLE public.venue OWNER TO postgres;

--
-- Name: venue_id_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE public.venue_id_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.venue_id_seq OWNER TO postgres;

--
-- Name: venue_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE public.venue_id_seq OWNED BY public.venue.id;


--
-- Name: courses id; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.courses ALTER COLUMN id SET DEFAULT nextval('public.courses_id_seq'::regclass);


--
-- Name: dept id; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.dept ALTER COLUMN id SET DEFAULT nextval('public.dept_id_seq'::regclass);


--
-- Name: depttrainings id; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.depttrainings ALTER COLUMN id SET DEFAULT nextval('public.depttrainings_id_seq'::regclass);


--
-- Name: designation id; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.designation ALTER COLUMN id SET DEFAULT nextval('public.designation_id_seq'::regclass);


--
-- Name: directorate id; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.directorate ALTER COLUMN id SET DEFAULT nextval('public.directorate_id_seq'::regclass);


--
-- Name: district id; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.district ALTER COLUMN id SET DEFAULT nextval('public.district_id_seq'::regclass);


--
-- Name: emd1 id; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.emd1 ALTER COLUMN id SET DEFAULT nextval('public.emd1_id_seq'::regclass);


--
-- Name: employee id; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.employee ALTER COLUMN id SET DEFAULT nextval('public.employee_id_seq'::regclass);


--
-- Name: files id; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.files ALTER COLUMN id SET DEFAULT nextval('public.files_id_seq'::regclass);


--
-- Name: infradirectorate id; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.infradirectorate ALTER COLUMN id SET DEFAULT nextval('public.infradirectorate_id_seq'::regclass);


--
-- Name: infradistrict id; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.infradistrict ALTER COLUMN id SET DEFAULT nextval('public.infradistrict_id_seq'::regclass);


--
-- Name: infrasecretariat id; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.infrasecretariat ALTER COLUMN id SET DEFAULT nextval('public.infrasecretariat_id_seq'::regclass);


--
-- Name: nodaldistrict id; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.nodaldistrict ALTER COLUMN id SET DEFAULT nextval('public.nodaldistrict_id_seq'::regclass);


--
-- Name: participation id; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.participation ALTER COLUMN id SET DEFAULT nextval('public.participation_id_seq'::regclass);


--
-- Name: receipts id; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.receipts ALTER COLUMN id SET DEFAULT nextval('public.receipts_id_seq'::regclass);


--
-- Name: report id; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.report ALTER COLUMN id SET DEFAULT nextval('public.report_id_seq'::regclass);


--
-- Name: secretariat id; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.secretariat ALTER COLUMN id SET DEFAULT nextval('public.secretariat_id_seq'::regclass);


--
-- Name: spoffice id; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.spoffice ALTER COLUMN id SET DEFAULT nextval('public.spoffice_id_seq'::regclass);


--
-- Name: trainings id; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.trainings ALTER COLUMN id SET DEFAULT nextval('public.trainings_id_seq'::regclass);


--
-- Name: venue id; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.venue ALTER COLUMN id SET DEFAULT nextval('public.venue_id_seq'::regclass);


--
-- Name: ci_sessions ci_sessions_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.ci_sessions
    ADD CONSTRAINT ci_sessions_pkey PRIMARY KEY (id);


--
-- Name: courses courses_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.courses
    ADD CONSTRAINT courses_pkey PRIMARY KEY (id);


--
-- Name: dept dept_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.dept
    ADD CONSTRAINT dept_pkey PRIMARY KEY (id);


--
-- Name: depttrainings depttrainings_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.depttrainings
    ADD CONSTRAINT depttrainings_pkey PRIMARY KEY (id);


--
-- Name: designation designation_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.designation
    ADD CONSTRAINT designation_pkey PRIMARY KEY (name);


--
-- Name: directorate directorate_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.directorate
    ADD CONSTRAINT directorate_pkey PRIMARY KEY (id);


--
-- Name: district district_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.district
    ADD CONSTRAINT district_pkey PRIMARY KEY (id);


--
-- Name: emd1 emd1_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.emd1
    ADD CONSTRAINT emd1_pkey PRIMARY KEY (id);


--
-- Name: employee employee_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.employee
    ADD CONSTRAINT employee_pkey PRIMARY KEY (id);


--
-- Name: files files_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.files
    ADD CONSTRAINT files_pkey PRIMARY KEY (id);


--
-- Name: infradirectorate infradirectorate_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.infradirectorate
    ADD CONSTRAINT infradirectorate_pkey PRIMARY KEY (id);


--
-- Name: infradistrict infradistrict_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.infradistrict
    ADD CONSTRAINT infradistrict_pkey PRIMARY KEY (id);


--
-- Name: infrasecretariat infrasecretariat_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.infrasecretariat
    ADD CONSTRAINT infrasecretariat_pkey PRIMARY KEY (id);


--
-- Name: nodaldistrict nodaldistrict_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.nodaldistrict
    ADD CONSTRAINT nodaldistrict_pkey PRIMARY KEY (id);


--
-- Name: participanttype participanttype_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.participanttype
    ADD CONSTRAINT participanttype_pkey PRIMARY KEY (name);


--
-- Name: participation participation_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.participation
    ADD CONSTRAINT participation_pkey PRIMARY KEY (id);


--
-- Name: receipts receipts_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.receipts
    ADD CONSTRAINT receipts_pkey PRIMARY KEY (id);


--
-- Name: report report_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.report
    ADD CONSTRAINT report_pkey PRIMARY KEY (id);


--
-- Name: role role_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.role
    ADD CONSTRAINT role_pkey PRIMARY KEY (name);


--
-- Name: secretariat secretariat_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.secretariat
    ADD CONSTRAINT secretariat_pkey PRIMARY KEY (id);


--
-- Name: spoffice spoffice_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.spoffice
    ADD CONSTRAINT spoffice_pkey PRIMARY KEY (id);


--
-- Name: trainings trainings_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.trainings
    ADD CONSTRAINT trainings_pkey PRIMARY KEY (id);


--
-- Name: trainingtype trainingtype_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.trainingtype
    ADD CONSTRAINT trainingtype_pkey PRIMARY KEY (name);


--
-- Name: type type_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.type
    ADD CONSTRAINT type_pkey PRIMARY KEY (name);


--
-- Name: venue venue_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.venue
    ADD CONSTRAINT venue_pkey PRIMARY KEY (id);


--
-- Name: ci_sessions_timestamp; Type: INDEX; Schema: public; Owner: postgres
--

CREATE INDEX ci_sessions_timestamp ON public.ci_sessions USING btree ("timestamp");


--
-- Name: depttrainings depttrainings_dept_fkey; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.depttrainings
    ADD CONSTRAINT depttrainings_dept_fkey FOREIGN KEY (dname) REFERENCES public.dept(id);


--
-- Name: depttrainings depttrainings_directorate_fkey; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.depttrainings
    ADD CONSTRAINT depttrainings_directorate_fkey FOREIGN KEY (directorate) REFERENCES public.directorate(id);


--
-- Name: depttrainings depttrainings_district_fkey; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.depttrainings
    ADD CONSTRAINT depttrainings_district_fkey FOREIGN KEY (district) REFERENCES public.district(id);


--
-- Name: depttrainings depttrainings_spoffice_fkey; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.depttrainings
    ADD CONSTRAINT depttrainings_spoffice_fkey FOREIGN KEY (spoffice) REFERENCES public.spoffice(id);


--
-- Name: depttrainings depttrainings_trainingid_fkey; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.depttrainings
    ADD CONSTRAINT depttrainings_trainingid_fkey FOREIGN KEY (trainingid) REFERENCES public.trainings(id);


--
-- Name: directorate directorate_dept_fkey; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.directorate
    ADD CONSTRAINT directorate_dept_fkey FOREIGN KEY (dept) REFERENCES public.dept(id);


--
-- Name: emd1 emd1_dept_fkey; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.emd1
    ADD CONSTRAINT emd1_dept_fkey FOREIGN KEY (dept) REFERENCES public.dept(id);


--
-- Name: emd1 emd1_designation_fkey; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.emd1
    ADD CONSTRAINT emd1_designation_fkey FOREIGN KEY (designation) REFERENCES public.designation(name);


--
-- Name: emd1 emd1_directorate_fkey; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.emd1
    ADD CONSTRAINT emd1_directorate_fkey FOREIGN KEY (directorate) REFERENCES public.directorate(id);


--
-- Name: emd1 emd1_district_fkey; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.emd1
    ADD CONSTRAINT emd1_district_fkey FOREIGN KEY (district) REFERENCES public.district(id);


--
-- Name: emd1 emd1_spoffice_fkey; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.emd1
    ADD CONSTRAINT emd1_spoffice_fkey FOREIGN KEY (spoffice) REFERENCES public.spoffice(id);


--
-- Name: emd1 emd1_type_fkey; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.emd1
    ADD CONSTRAINT emd1_type_fkey FOREIGN KEY (type) REFERENCES public.type(name);


--
-- Name: employee employee_dept_fkey; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.employee
    ADD CONSTRAINT employee_dept_fkey FOREIGN KEY (dept) REFERENCES public.dept(id);


--
-- Name: employee employee_designation_fkey; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.employee
    ADD CONSTRAINT employee_designation_fkey FOREIGN KEY (designation) REFERENCES public.designation(name);


--
-- Name: employee employee_directorate_fkey; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.employee
    ADD CONSTRAINT employee_directorate_fkey FOREIGN KEY (directorate) REFERENCES public.directorate(id);


--
-- Name: employee employee_district_fkey; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.employee
    ADD CONSTRAINT employee_district_fkey FOREIGN KEY (district) REFERENCES public.district(id);


--
-- Name: employee employee_role_fkey; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.employee
    ADD CONSTRAINT employee_role_fkey FOREIGN KEY (role) REFERENCES public.role(name);


--
-- Name: employee employee_spoffice_fkey; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.employee
    ADD CONSTRAINT employee_spoffice_fkey FOREIGN KEY (spoffice) REFERENCES public.spoffice(id);


--
-- Name: files files_dept_fkey; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.files
    ADD CONSTRAINT files_dept_fkey FOREIGN KEY (dept) REFERENCES public.dept(id);


--
-- Name: files files_directorate_fkey; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.files
    ADD CONSTRAINT files_directorate_fkey FOREIGN KEY (directorate) REFERENCES public.directorate(id);


--
-- Name: files files_district_fkey; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.files
    ADD CONSTRAINT files_district_fkey FOREIGN KEY (district) REFERENCES public.district(id);


--
-- Name: files files_spoffice_fkey; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.files
    ADD CONSTRAINT files_spoffice_fkey FOREIGN KEY (spoffice) REFERENCES public.spoffice(id);


--
-- Name: infradirectorate infradirectorate_dept_fkey; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.infradirectorate
    ADD CONSTRAINT infradirectorate_dept_fkey FOREIGN KEY (dept) REFERENCES public.dept(id);


--
-- Name: infradirectorate infradirectorate_directorate_fkey; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.infradirectorate
    ADD CONSTRAINT infradirectorate_directorate_fkey FOREIGN KEY (directorate) REFERENCES public.directorate(id);


--
-- Name: infradirectorate infradirectorate_district_fkey; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.infradirectorate
    ADD CONSTRAINT infradirectorate_district_fkey FOREIGN KEY (district) REFERENCES public.district(id);


--
-- Name: infradirectorate infradirectorate_spoffice_fkey; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.infradirectorate
    ADD CONSTRAINT infradirectorate_spoffice_fkey FOREIGN KEY (spoffice) REFERENCES public.spoffice(id);


--
-- Name: infradistrict infradistrict_district_fkey; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.infradistrict
    ADD CONSTRAINT infradistrict_district_fkey FOREIGN KEY (district) REFERENCES public.district(id);


--
-- Name: infrasecretariat infrasecretariat_dept_fkey; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.infrasecretariat
    ADD CONSTRAINT infrasecretariat_dept_fkey FOREIGN KEY (dept) REFERENCES public.dept(id);


--
-- Name: infrasecretariat infrasecretariat_directorate_fkey; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.infrasecretariat
    ADD CONSTRAINT infrasecretariat_directorate_fkey FOREIGN KEY (directorate) REFERENCES public.directorate(id);


--
-- Name: infrasecretariat infrasecretariat_district_fkey; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.infrasecretariat
    ADD CONSTRAINT infrasecretariat_district_fkey FOREIGN KEY (district) REFERENCES public.district(id);


--
-- Name: nodaldistrict nodaldistrict_designation_fkey; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.nodaldistrict
    ADD CONSTRAINT nodaldistrict_designation_fkey FOREIGN KEY (designation) REFERENCES public.designation(name);


--
-- Name: nodaldistrict nodaldistrict_district_fkey; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.nodaldistrict
    ADD CONSTRAINT nodaldistrict_district_fkey FOREIGN KEY (district) REFERENCES public.district(id);


--
-- Name: participation participation_dept_fkey; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.participation
    ADD CONSTRAINT participation_dept_fkey FOREIGN KEY (dept) REFERENCES public.dept(id);


--
-- Name: participation participation_designation_fkey; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.participation
    ADD CONSTRAINT participation_designation_fkey FOREIGN KEY (designation) REFERENCES public.designation(name);


--
-- Name: participation participation_direct_fkey; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.participation
    ADD CONSTRAINT participation_direct_fkey FOREIGN KEY (direct) REFERENCES public.directorate(id);


--
-- Name: participation participation_dist_fkey; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.participation
    ADD CONSTRAINT participation_dist_fkey FOREIGN KEY (dist) REFERENCES public.district(id);


--
-- Name: participation participation_spofc_fkey; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.participation
    ADD CONSTRAINT participation_spofc_fkey FOREIGN KEY (spofc) REFERENCES public.spoffice(id);


--
-- Name: participation participation_trainingsid_fkey; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.participation
    ADD CONSTRAINT participation_trainingsid_fkey FOREIGN KEY (trainingsid) REFERENCES public.trainings(id);


--
-- Name: participation participation_type_fkey; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.participation
    ADD CONSTRAINT participation_type_fkey FOREIGN KEY (type) REFERENCES public.participanttype(name);


--
-- Name: receipts receipts_dept_fkey; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.receipts
    ADD CONSTRAINT receipts_dept_fkey FOREIGN KEY (dept) REFERENCES public.dept(id);


--
-- Name: receipts receipts_directorate_fkey; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.receipts
    ADD CONSTRAINT receipts_directorate_fkey FOREIGN KEY (directorate) REFERENCES public.directorate(id);


--
-- Name: receipts receipts_district_fkey; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.receipts
    ADD CONSTRAINT receipts_district_fkey FOREIGN KEY (district) REFERENCES public.district(id);


--
-- Name: receipts receipts_spoffice_fkey; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.receipts
    ADD CONSTRAINT receipts_spoffice_fkey FOREIGN KEY (spoffice) REFERENCES public.spoffice(id);


--
-- Name: report report_dept_fkey; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.report
    ADD CONSTRAINT report_dept_fkey FOREIGN KEY (dept) REFERENCES public.dept(id);


--
-- Name: report report_directorate_fkey; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.report
    ADD CONSTRAINT report_directorate_fkey FOREIGN KEY (directorate) REFERENCES public.directorate(id);


--
-- Name: report report_district_fkey; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.report
    ADD CONSTRAINT report_district_fkey FOREIGN KEY (district) REFERENCES public.district(id);


--
-- Name: report report_spoffice_fkey; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.report
    ADD CONSTRAINT report_spoffice_fkey FOREIGN KEY (spoffice) REFERENCES public.spoffice(id);


--
-- Name: secretariat secretariat_dept_fkey; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.secretariat
    ADD CONSTRAINT secretariat_dept_fkey FOREIGN KEY (dept) REFERENCES public.dept(id);


--
-- Name: secretariat secretariat_designation_fkey; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.secretariat
    ADD CONSTRAINT secretariat_designation_fkey FOREIGN KEY (designation) REFERENCES public.designation(name);


--
-- Name: secretariat secretariat_directorate_fkey; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.secretariat
    ADD CONSTRAINT secretariat_directorate_fkey FOREIGN KEY (directorate) REFERENCES public.directorate(id);


--
-- Name: trainings trainings_course_fkey; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.trainings
    ADD CONSTRAINT trainings_course_fkey FOREIGN KEY (course) REFERENCES public.courses(id);


--
-- Name: trainings trainings_type_fkey; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.trainings
    ADD CONSTRAINT trainings_type_fkey FOREIGN KEY (type) REFERENCES public.trainingtype(name);


--
-- PostgreSQL database dump complete
--

