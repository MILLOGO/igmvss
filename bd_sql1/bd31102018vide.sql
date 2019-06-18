--
-- PostgreSQL database dump
--

-- Dumped from database version 9.5.3
-- Dumped by pg_dump version 9.5.3

-- Started on 2018-11-01 11:52:17

SET statement_timeout = 0;
SET lock_timeout = 0;
SET client_encoding = 'UTF8';
SET standard_conforming_strings = on;
SET check_function_bodies = false;
SET client_min_messages = warning;
SET row_security = off;

--
-- TOC entry 1 (class 3079 OID 12355)
-- Name: plpgsql; Type: EXTENSION; Schema: -; Owner: 
--

CREATE EXTENSION IF NOT EXISTS plpgsql WITH SCHEMA pg_catalog;


--
-- TOC entry 2801 (class 0 OID 0)
-- Dependencies: 1
-- Name: EXTENSION plpgsql; Type: COMMENT; Schema: -; Owner: 
--

COMMENT ON EXTENSION plpgsql IS 'PL/pgSQL procedural language';


SET search_path = public, pg_catalog;

SET default_tablespace = '';

SET default_with_oids = false;

--
-- TOC entry 181 (class 1259 OID 139707)
-- Name: amenagement; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE amenagement (
    idamenagement integer NOT NULL,
    idcategorieamenagement integer NOT NULL,
    nomamenagement character varying(255) NOT NULL,
    souscategorieamenagement character varying(255) DEFAULT NULL::character varying,
    infosspec integer DEFAULT 0
);


ALTER TABLE amenagement OWNER TO postgres;

--
-- TOC entry 182 (class 1259 OID 139715)
-- Name: amenagement_idamenagement_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE amenagement_idamenagement_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE amenagement_idamenagement_seq OWNER TO postgres;

--
-- TOC entry 2802 (class 0 OID 0)
-- Dependencies: 182
-- Name: amenagement_idamenagement_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE amenagement_idamenagement_seq OWNED BY amenagement.idamenagement;


--
-- TOC entry 183 (class 1259 OID 139717)
-- Name: amenager; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE amenager (
    idamenager integer NOT NULL,
    idamenagement integer NOT NULL,
    idsite integer NOT NULL,
    idoperateur integer NOT NULL,
    superficieciblee numeric,
    periodedebut date,
    periodefin date,
    idprojet integer,
    typemesuresite character varying(15)
);


ALTER TABLE amenager OWNER TO postgres;

--
-- TOC entry 184 (class 1259 OID 139723)
-- Name: amenager_espece; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE amenager_espece (
    idamenagerespece integer NOT NULL,
    idamenager integer NOT NULL,
    idespece integer NOT NULL,
    nbreplant integer,
    quantitesemis integer,
    tauxsurvie numeric,
    tauxreprise numeric
);


ALTER TABLE amenager_espece OWNER TO postgres;

--
-- TOC entry 185 (class 1259 OID 139729)
-- Name: amenager_espece_idamenagerespece_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE amenager_espece_idamenagerespece_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE amenager_espece_idamenagerespece_seq OWNER TO postgres;

--
-- TOC entry 2803 (class 0 OID 0)
-- Dependencies: 185
-- Name: amenager_espece_idamenagerespece_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE amenager_espece_idamenagerespece_seq OWNED BY amenager_espece.idamenagerespece;


--
-- TOC entry 186 (class 1259 OID 139731)
-- Name: amenager_idamenager_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE amenager_idamenager_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE amenager_idamenager_seq OWNER TO postgres;

--
-- TOC entry 2804 (class 0 OID 0)
-- Dependencies: 186
-- Name: amenager_idamenager_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE amenager_idamenager_seq OWNED BY amenager.idamenager;


--
-- TOC entry 187 (class 1259 OID 139733)
-- Name: amenager_vegetalisation; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE amenager_vegetalisation (
    idamenagervegetalisation integer NOT NULL,
    idamenager integer NOT NULL,
    idvegetalisation integer NOT NULL
);


ALTER TABLE amenager_vegetalisation OWNER TO postgres;

--
-- TOC entry 188 (class 1259 OID 139736)
-- Name: amenager_vegetalisation_idamenagervegetalisation_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE amenager_vegetalisation_idamenagervegetalisation_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE amenager_vegetalisation_idamenagervegetalisation_seq OWNER TO postgres;

--
-- TOC entry 2805 (class 0 OID 0)
-- Dependencies: 188
-- Name: amenager_vegetalisation_idamenagervegetalisation_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE amenager_vegetalisation_idamenagervegetalisation_seq OWNED BY amenager_vegetalisation.idamenagervegetalisation;


--
-- TOC entry 189 (class 1259 OID 139738)
-- Name: localite; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE localite (
    idlocalite integer NOT NULL,
    idcommune integer NOT NULL,
    nomlocalite character varying(255) NOT NULL
);


ALTER TABLE localite OWNER TO postgres;

--
-- TOC entry 190 (class 1259 OID 139741)
-- Name: operateur; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE operateur (
    idoperateur integer NOT NULL,
    nomoperateur character varying(255) NOT NULL,
    nomcontactoperateur character varying(255) NOT NULL,
    prenomcontactoperateur character varying(255) NOT NULL,
    emailcontactoperateur character varying(255) NOT NULL,
    numcontactoperateur character varying(50) NOT NULL,
    fonctioncontactoperateur character varying(255) DEFAULT NULL::character varying,
    siteinternetoperateur character varying(255) DEFAULT NULL::character varying
);


ALTER TABLE operateur OWNER TO postgres;

--
-- TOC entry 191 (class 1259 OID 139749)
-- Name: projet; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE projet (
    idprojet integer NOT NULL,
    nomprojet character varying(255) NOT NULL,
    budgetglobal numeric,
    budgetgmv numeric,
    datedebutprojet date NOT NULL,
    datefinprojet date NOT NULL,
    nomcontactprojet character varying(255) NOT NULL,
    prenomcontactprojet character varying(255) NOT NULL,
    numcontactprojet character varying(50) DEFAULT NULL::character varying,
    emailcontactprojet character varying(255) DEFAULT NULL::character varying,
    siteinternetprojet character varying(255) DEFAULT NULL::character varying,
    descriptionprojet text
);


ALTER TABLE projet OWNER TO postgres;

--
-- TOC entry 192 (class 1259 OID 139758)
-- Name: site; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE site (
    idsite integer NOT NULL,
    idlocalite integer NOT NULL,
    idgestionnaire integer NOT NULL,
    idstatutfoncier integer NOT NULL,
    idvocation integer NOT NULL,
    nomsite character varying(255) NOT NULL,
    superficiesite numeric DEFAULT 0,
    typemesuresite character varying(15),
    typegeom character varying(25),
    geometrie text
);


ALTER TABLE site OWNER TO postgres;

--
-- TOC entry 193 (class 1259 OID 139765)
-- Name: vueamenager; Type: VIEW; Schema: public; Owner: postgres
--

CREATE VIEW vueamenager AS
 SELECT amenager.idamenager,
    amenager.idamenagement,
    amenager.idsite,
    amenager.idoperateur,
    amenager.superficieciblee,
    amenager.periodedebut,
    amenager.periodefin,
    amenager.idprojet,
    site.nomsite,
    site.superficiesite,
    localite.nomlocalite,
    localite.idcommune,
    projet.nomprojet,
    projet.budgetglobal,
    projet.budgetgmv,
    projet.datedebutprojet,
    projet.datefinprojet,
    projet.nomcontactprojet,
    projet.prenomcontactprojet,
    projet.numcontactprojet,
    projet.emailcontactprojet,
    projet.siteinternetprojet,
    projet.descriptionprojet,
    operateur.nomoperateur,
    operateur.nomcontactoperateur,
    operateur.prenomcontactoperateur,
    operateur.emailcontactoperateur,
    operateur.numcontactoperateur,
    operateur.fonctioncontactoperateur,
    operateur.siteinternetoperateur,
    site.idgestionnaire,
    site.idstatutfoncier,
    site.idvocation,
    site.typemesuresite,
    amenager.typemesuresite AS typeamenagersite
   FROM amenager,
    site,
    localite,
    projet,
    operateur
  WHERE ((amenager.idsite = site.idsite) AND (amenager.idprojet = projet.idprojet) AND (amenager.idoperateur = operateur.idoperateur) AND (site.idlocalite = localite.idlocalite));


ALTER TABLE vueamenager OWNER TO postgres;

--
-- TOC entry 194 (class 1259 OID 139770)
-- Name: amenagerview; Type: VIEW; Schema: public; Owner: postgres
--

CREATE VIEW amenagerview AS
 SELECT vueamenager.idamenager,
    vueamenager.idsite,
    vueamenager.idoperateur,
    vueamenager.superficieciblee,
    vueamenager.periodedebut,
    vueamenager.periodefin,
    vueamenager.idprojet,
    vueamenager.nomsite,
    vueamenager.superficiesite,
    vueamenager.idcommune,
    amenagement.idamenagement,
    amenagement.idcategorieamenagement,
    amenagement.infosspec,
    site.idlocalite,
    vueamenager.typemesuresite,
    vueamenager.typeamenagersite
   FROM vueamenager,
    amenagement,
    site
  WHERE ((vueamenager.idsite = site.idsite) AND (amenagement.idamenagement = vueamenager.idamenagement));


ALTER TABLE amenagerview OWNER TO postgres;

--
-- TOC entry 195 (class 1259 OID 139775)
-- Name: vueamenagersansprojet; Type: VIEW; Schema: public; Owner: postgres
--

CREATE VIEW vueamenagersansprojet AS
 SELECT localite.idlocalite,
    localite.idcommune,
    localite.nomlocalite,
    site.idsite,
    site.idgestionnaire,
    site.idstatutfoncier,
    site.idvocation,
    site.nomsite,
    site.superficiesite,
    amenager.idamenager,
    amenager.idamenagement,
    amenager.superficieciblee,
    amenager.periodedebut,
    amenager.periodefin,
    amenager.idprojet,
    operateur.nomoperateur,
    operateur.nomcontactoperateur,
    operateur.prenomcontactoperateur,
    operateur.emailcontactoperateur,
    operateur.numcontactoperateur,
    operateur.fonctioncontactoperateur,
    operateur.siteinternetoperateur,
    operateur.idoperateur,
    site.typemesuresite,
    amenager.typemesuresite AS typeamenagersite
   FROM amenager,
    localite,
    operateur,
    site
  WHERE ((amenager.idoperateur = operateur.idoperateur) AND (localite.idlocalite = site.idlocalite) AND (site.idsite = amenager.idsite) AND (amenager.idprojet = '-1'::integer));


ALTER TABLE vueamenagersansprojet OWNER TO postgres;

--
-- TOC entry 196 (class 1259 OID 139780)
-- Name: amenagerviewsansprojet; Type: VIEW; Schema: public; Owner: postgres
--

CREATE VIEW amenagerviewsansprojet AS
 SELECT vueamenagersansprojet.idamenager,
    vueamenagersansprojet.idsite,
    vueamenagersansprojet.idoperateur,
    vueamenagersansprojet.superficieciblee,
    vueamenagersansprojet.periodedebut,
    vueamenagersansprojet.periodefin,
    vueamenagersansprojet.idprojet,
    vueamenagersansprojet.nomsite,
    vueamenagersansprojet.superficiesite,
    vueamenagersansprojet.idcommune,
    amenagement.idamenagement,
    amenagement.idcategorieamenagement,
    amenagement.infosspec,
    site.idlocalite,
    vueamenagersansprojet.typemesuresite,
    vueamenagersansprojet.typeamenagersite
   FROM vueamenagersansprojet,
    amenagement,
    site
  WHERE ((vueamenagersansprojet.idamenagement = amenagement.idamenagement) AND (site.idsite = vueamenagersansprojet.idsite));


ALTER TABLE amenagerviewsansprojet OWNER TO postgres;

--
-- TOC entry 197 (class 1259 OID 139784)
-- Name: appui; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE appui (
    idappui integer NOT NULL,
    typeappui character varying(255) NOT NULL
);


ALTER TABLE appui OWNER TO postgres;

--
-- TOC entry 198 (class 1259 OID 139787)
-- Name: appui_idappui_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE appui_idappui_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE appui_idappui_seq OWNER TO postgres;

--
-- TOC entry 2806 (class 0 OID 0)
-- Dependencies: 198
-- Name: appui_idappui_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE appui_idappui_seq OWNED BY appui.idappui;


--
-- TOC entry 199 (class 1259 OID 139789)
-- Name: gestionnaire; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE gestionnaire (
    idgestionnaire integer NOT NULL,
    typegestionnaire character varying(25) NOT NULL,
    nomgestionnaire character varying(255) NOT NULL,
    prenomgestionnaire character varying(255) NOT NULL,
    numgestionnaire character varying(50) NOT NULL,
    emailgestionnaire character varying(255) NOT NULL,
    datenaissance date,
    sexe character varying(25),
    nbrepersonnemenage integer,
    nbrepersonnemoinsseizeans integer,
    nomcollectif character varying(255),
    genrecollectif character varying(25),
    typecollectif character varying(255),
    nbremembrecollectif integer
);


ALTER TABLE gestionnaire OWNER TO postgres;

--
-- TOC entry 200 (class 1259 OID 139795)
-- Name: recevoir_appui_gest_op; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE recevoir_appui_gest_op (
    idappuigestop integer NOT NULL,
    idoperateur integer NOT NULL,
    idappui integer NOT NULL,
    idgestionnaire integer NOT NULL,
    datedebutappui date,
    datefinappui date,
    nbrebeneficiaire integer DEFAULT 0,
    descriptionappui text,
    exploitationpfnl boolean DEFAULT false,
    idprojet integer
);


ALTER TABLE recevoir_appui_gest_op OWNER TO postgres;

--
-- TOC entry 201 (class 1259 OID 139803)
-- Name: appuigestop; Type: VIEW; Schema: public; Owner: postgres
--

CREATE VIEW appuigestop AS
 SELECT recevoir_appui_gest_op.idappuigestop,
    recevoir_appui_gest_op.datedebutappui,
    recevoir_appui_gest_op.datefinappui,
    recevoir_appui_gest_op.nbrebeneficiaire,
    recevoir_appui_gest_op.descriptionappui,
    recevoir_appui_gest_op.exploitationpfnl,
    recevoir_appui_gest_op.idprojet,
    operateur.idoperateur,
    operateur.nomoperateur,
    operateur.nomcontactoperateur,
    operateur.prenomcontactoperateur,
    operateur.emailcontactoperateur,
    operateur.numcontactoperateur,
    operateur.fonctioncontactoperateur,
    operateur.siteinternetoperateur,
    gestionnaire.idgestionnaire,
    gestionnaire.typegestionnaire,
    gestionnaire.nomgestionnaire,
    gestionnaire.prenomgestionnaire,
    gestionnaire.numgestionnaire,
    gestionnaire.emailgestionnaire,
    gestionnaire.datenaissance,
    gestionnaire.sexe,
    gestionnaire.nbrepersonnemenage,
    gestionnaire.nbrepersonnemoinsseizeans,
    gestionnaire.nomcollectif,
    gestionnaire.genrecollectif,
    gestionnaire.typecollectif,
    gestionnaire.nbremembrecollectif,
    appui.typeappui,
    appui.idappui
   FROM gestionnaire,
    recevoir_appui_gest_op,
    operateur,
    appui
  WHERE ((gestionnaire.idgestionnaire = recevoir_appui_gest_op.idgestionnaire) AND (recevoir_appui_gest_op.idoperateur = operateur.idoperateur) AND (appui.idappui = recevoir_appui_gest_op.idappui));


ALTER TABLE appuigestop OWNER TO postgres;

--
-- TOC entry 202 (class 1259 OID 139808)
-- Name: bailleur; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE bailleur (
    idbailleur integer NOT NULL,
    nombailleur character varying(255) NOT NULL,
    nomcontactbailleur character varying(255) NOT NULL,
    prenomcontactbailleur character varying(255) NOT NULL,
    numcontactbailleur character varying(50) NOT NULL,
    emailcontactbailleur character varying(255) DEFAULT NULL::character varying,
    descriptionbailleur text
);


ALTER TABLE bailleur OWNER TO postgres;

--
-- TOC entry 203 (class 1259 OID 139815)
-- Name: bailleur_idbailleur_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE bailleur_idbailleur_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE bailleur_idbailleur_seq OWNER TO postgres;

--
-- TOC entry 2807 (class 0 OID 0)
-- Dependencies: 203
-- Name: bailleur_idbailleur_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE bailleur_idbailleur_seq OWNED BY bailleur.idbailleur;


--
-- TOC entry 204 (class 1259 OID 139817)
-- Name: categorieamenagement; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE categorieamenagement (
    idcategorieamenagement integer NOT NULL,
    nomcategorieamenagement character varying(255) NOT NULL
);


ALTER TABLE categorieamenagement OWNER TO postgres;

--
-- TOC entry 205 (class 1259 OID 139820)
-- Name: categorieamenagement_idcategorieamenagement_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE categorieamenagement_idcategorieamenagement_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE categorieamenagement_idcategorieamenagement_seq OWNER TO postgres;

--
-- TOC entry 2808 (class 0 OID 0)
-- Dependencies: 205
-- Name: categorieamenagement_idcategorieamenagement_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE categorieamenagement_idcategorieamenagement_seq OWNED BY categorieamenagement.idcategorieamenagement;


--
-- TOC entry 206 (class 1259 OID 139822)
-- Name: categorievocation; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE categorievocation (
    idcategorievocation integer NOT NULL,
    nomcategorievocation character varying(255) NOT NULL
);


ALTER TABLE categorievocation OWNER TO postgres;

--
-- TOC entry 207 (class 1259 OID 139825)
-- Name: categorievocation_idcategorievocation_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE categorievocation_idcategorievocation_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE categorievocation_idcategorievocation_seq OWNER TO postgres;

--
-- TOC entry 2809 (class 0 OID 0)
-- Dependencies: 207
-- Name: categorievocation_idcategorievocation_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE categorievocation_idcategorievocation_seq OWNED BY categorievocation.idcategorievocation;


--
-- TOC entry 208 (class 1259 OID 139827)
-- Name: collecteur; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE collecteur (
    idcollecteur integer NOT NULL,
    nomcollecteur character varying(255) NOT NULL,
    prenomcollecteur character varying(255) NOT NULL,
    fonctioncollecteur character varying(255) DEFAULT NULL::character varying,
    numcollecteur character varying(100) DEFAULT NULL::character varying,
    emailcollecteur character varying(255) DEFAULT NULL::character varying
);


ALTER TABLE collecteur OWNER TO postgres;

--
-- TOC entry 209 (class 1259 OID 139836)
-- Name: collecteur_idcollecteur_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE collecteur_idcollecteur_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE collecteur_idcollecteur_seq OWNER TO postgres;

--
-- TOC entry 2810 (class 0 OID 0)
-- Dependencies: 209
-- Name: collecteur_idcollecteur_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE collecteur_idcollecteur_seq OWNED BY collecteur.idcollecteur;


--
-- TOC entry 210 (class 1259 OID 139838)
-- Name: commune; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE commune (
    idcommune integer NOT NULL,
    idprovince integer NOT NULL,
    nomcommune character varying(255) NOT NULL,
    nbrehomme integer,
    nbrefemme integer,
    totalpopulation integer,
    nbremenage integer
);


ALTER TABLE commune OWNER TO postgres;

--
-- TOC entry 211 (class 1259 OID 139841)
-- Name: commune_idcommune_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE commune_idcommune_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE commune_idcommune_seq OWNER TO postgres;

--
-- TOC entry 2811 (class 0 OID 0)
-- Dependencies: 211
-- Name: commune_idcommune_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE commune_idcommune_seq OWNED BY commune.idcommune;


--
-- TOC entry 212 (class 1259 OID 139843)
-- Name: correspondre_site_geomorphologie; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE correspondre_site_geomorphologie (
    idsitegeomorphologie integer NOT NULL,
    idtypegeomorphologie integer NOT NULL,
    idsite integer NOT NULL
);


ALTER TABLE correspondre_site_geomorphologie OWNER TO postgres;

--
-- TOC entry 213 (class 1259 OID 139846)
-- Name: correspondre_site_geomorphologie_idsitegeomorphologie_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE correspondre_site_geomorphologie_idsitegeomorphologie_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE correspondre_site_geomorphologie_idsitegeomorphologie_seq OWNER TO postgres;

--
-- TOC entry 2812 (class 0 OID 0)
-- Dependencies: 213
-- Name: correspondre_site_geomorphologie_idsitegeomorphologie_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE correspondre_site_geomorphologie_idsitegeomorphologie_seq OWNED BY correspondre_site_geomorphologie.idsitegeomorphologie;


--
-- TOC entry 214 (class 1259 OID 139848)
-- Name: correspondre_site_typesol; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE correspondre_site_typesol (
    idsitetypesol integer NOT NULL,
    idtypesol integer NOT NULL,
    idsite integer NOT NULL
);


ALTER TABLE correspondre_site_typesol OWNER TO postgres;

--
-- TOC entry 215 (class 1259 OID 139851)
-- Name: correspondre_site_typesol_idsitetypesol_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE correspondre_site_typesol_idsitetypesol_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE correspondre_site_typesol_idsitetypesol_seq OWNER TO postgres;

--
-- TOC entry 2813 (class 0 OID 0)
-- Dependencies: 215
-- Name: correspondre_site_typesol_idsitetypesol_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE correspondre_site_typesol_idsitetypesol_seq OWNED BY correspondre_site_typesol.idsitetypesol;


--
-- TOC entry 216 (class 1259 OID 139853)
-- Name: province; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE province (
    idprovince integer NOT NULL,
    idregion integer NOT NULL,
    nomprovince character varying(255) NOT NULL
);


ALTER TABLE province OWNER TO postgres;

--
-- TOC entry 217 (class 1259 OID 139856)
-- Name: region; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE region (
    idregion integer NOT NULL,
    nomregion character varying(255) NOT NULL
);


ALTER TABLE region OWNER TO postgres;

--
-- TOC entry 218 (class 1259 OID 139859)
-- Name: detailamenageravcprojet; Type: VIEW; Schema: public; Owner: postgres
--

CREATE VIEW detailamenageravcprojet AS
 SELECT amenagerview.idamenager,
    amenagerview.superficieciblee,
    amenagerview.periodedebut,
    amenagerview.periodefin,
    amenagerview.superficiesite,
    site.idsite,
    site.nomsite,
    localite.nomlocalite,
    localite.idlocalite,
    province.nomprovince,
    commune.nomcommune,
    region.nomregion,
    region.idregion,
    commune.idcommune,
    province.idprovince,
    categorieamenagement.nomcategorieamenagement,
    categorieamenagement.idcategorieamenagement,
    amenagement.idamenagement,
    amenagement.nomamenagement,
    amenagement.souscategorieamenagement,
    operateur.idoperateur,
    operateur.nomoperateur,
    projet.nomprojet,
    projet.idprojet,
    site.typemesuresite,
    amenagerview.typeamenagersite
   FROM amenagerview,
    categorieamenagement,
    localite,
    region,
    province,
    site,
    commune,
    amenagement,
    operateur,
    projet
  WHERE ((amenagerview.idsite = site.idsite) AND (amenagerview.idprojet = projet.idprojet) AND (amenagerview.idoperateur = operateur.idoperateur) AND (categorieamenagement.idcategorieamenagement = amenagerview.idcategorieamenagement) AND (localite.idlocalite = amenagerview.idlocalite) AND (region.idregion = province.idregion) AND (province.idprovince = commune.idprovince) AND (commune.idcommune = amenagerview.idcommune) AND (amenagement.idamenagement = amenagerview.idamenagement));


ALTER TABLE detailamenageravcprojet OWNER TO postgres;

--
-- TOC entry 219 (class 1259 OID 139864)
-- Name: detailamenagersansprojet; Type: VIEW; Schema: public; Owner: postgres
--

CREATE VIEW detailamenagersansprojet AS
 SELECT amenagerviewsansprojet.idamenager,
    amenagerviewsansprojet.superficieciblee,
    amenagerviewsansprojet.periodedebut,
    amenagerviewsansprojet.periodefin,
    amenagerviewsansprojet.superficiesite,
    site.idsite,
    site.nomsite,
    localite.nomlocalite,
    localite.idlocalite,
    province.nomprovince,
    commune.nomcommune,
    region.nomregion,
    region.idregion,
    commune.idcommune,
    province.idprovince,
    categorieamenagement.nomcategorieamenagement,
    categorieamenagement.idcategorieamenagement,
    amenagement.idamenagement,
    amenagement.nomamenagement,
    amenagement.souscategorieamenagement,
    operateur.idoperateur,
    operateur.nomoperateur,
    amenagerviewsansprojet.idprojet,
    site.typemesuresite,
    amenagerviewsansprojet.typeamenagersite
   FROM amenagerviewsansprojet,
    site,
    localite,
    province,
    commune,
    region,
    categorieamenagement,
    amenagement,
    operateur
  WHERE ((amenagerviewsansprojet.idcategorieamenagement = categorieamenagement.idcategorieamenagement) AND (amenagerviewsansprojet.idamenagement = amenagement.idamenagement) AND (amenagerviewsansprojet.idoperateur = operateur.idoperateur) AND (site.idsite = amenagerviewsansprojet.idsite) AND (localite.idlocalite = amenagerviewsansprojet.idlocalite) AND (province.idprovince = commune.idprovince) AND (commune.idcommune = amenagerviewsansprojet.idcommune) AND (region.idregion = province.idregion));


ALTER TABLE detailamenagersansprojet OWNER TO postgres;

--
-- TOC entry 220 (class 1259 OID 139869)
-- Name: espece; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE espece (
    idespece integer NOT NULL,
    nomespece character varying(255) NOT NULL,
    descriptionespece text
);


ALTER TABLE espece OWNER TO postgres;

--
-- TOC entry 221 (class 1259 OID 139875)
-- Name: espece_idespece_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE espece_idespece_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE espece_idespece_seq OWNER TO postgres;

--
-- TOC entry 2814 (class 0 OID 0)
-- Dependencies: 221
-- Name: espece_idespece_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE espece_idespece_seq OWNED BY espece.idespece;


--
-- TOC entry 222 (class 1259 OID 139877)
-- Name: executer_operateur_projet; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE executer_operateur_projet (
    idoperateurprojet integer NOT NULL,
    idoperateur integer NOT NULL,
    idprojet integer NOT NULL,
    fonctiontechnique boolean,
    fonctionfinanciere boolean,
    montantfinancement numeric
);


ALTER TABLE executer_operateur_projet OWNER TO postgres;

--
-- TOC entry 223 (class 1259 OID 139883)
-- Name: excuterprojetoperateur; Type: VIEW; Schema: public; Owner: postgres
--

CREATE VIEW excuterprojetoperateur AS
 SELECT executer_operateur_projet.idoperateurprojet,
    executer_operateur_projet.idoperateur,
    executer_operateur_projet.idprojet,
    executer_operateur_projet.fonctiontechnique,
    executer_operateur_projet.fonctionfinanciere,
    executer_operateur_projet.montantfinancement,
    operateur.nomoperateur
   FROM executer_operateur_projet,
    operateur
  WHERE (operateur.idoperateur = executer_operateur_projet.idoperateur);


ALTER TABLE excuterprojetoperateur OWNER TO postgres;

--
-- TOC entry 224 (class 1259 OID 139887)
-- Name: executer_operateur_projet_idoperateurprojet_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE executer_operateur_projet_idoperateurprojet_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE executer_operateur_projet_idoperateurprojet_seq OWNER TO postgres;

--
-- TOC entry 2815 (class 0 OID 0)
-- Dependencies: 224
-- Name: executer_operateur_projet_idoperateurprojet_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE executer_operateur_projet_idoperateurprojet_seq OWNED BY executer_operateur_projet.idoperateurprojet;


--
-- TOC entry 225 (class 1259 OID 139889)
-- Name: executer_projet_commune; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE executer_projet_commune (
    idprojetcommune integer NOT NULL,
    idcommune integer NOT NULL,
    idprojet integer NOT NULL
);


ALTER TABLE executer_projet_commune OWNER TO postgres;

--
-- TOC entry 226 (class 1259 OID 139892)
-- Name: executer_projet_commune_idprojetcommune_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE executer_projet_commune_idprojetcommune_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE executer_projet_commune_idprojetcommune_seq OWNER TO postgres;

--
-- TOC entry 2816 (class 0 OID 0)
-- Dependencies: 226
-- Name: executer_projet_commune_idprojetcommune_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE executer_projet_commune_idprojetcommune_seq OWNED BY executer_projet_commune.idprojetcommune;


--
-- TOC entry 227 (class 1259 OID 139894)
-- Name: executerprojetdanscommune; Type: VIEW; Schema: public; Owner: postgres
--

CREATE VIEW executerprojetdanscommune AS
 SELECT executer_projet_commune.idprojetcommune,
    executer_projet_commune.idcommune,
    commune.nomcommune,
    province.nomprovince,
    region.nomregion,
    executer_projet_commune.idprojet
   FROM commune,
    executer_projet_commune,
    region,
    province
  WHERE ((commune.idcommune = executer_projet_commune.idcommune) AND (province.idregion = region.idregion) AND (province.idprovince = commune.idprovince));


ALTER TABLE executerprojetdanscommune OWNER TO postgres;

--
-- TOC entry 228 (class 1259 OID 139898)
-- Name: exploitation; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE exploitation (
    idexploitation integer NOT NULL,
    libelle character varying(255)
);


ALTER TABLE exploitation OWNER TO postgres;

--
-- TOC entry 229 (class 1259 OID 139901)
-- Name: exploitatio_idexploitation_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE exploitatio_idexploitation_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE exploitatio_idexploitation_seq OWNER TO postgres;

--
-- TOC entry 2817 (class 0 OID 0)
-- Dependencies: 229
-- Name: exploitatio_idexploitation_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE exploitatio_idexploitation_seq OWNED BY exploitation.idexploitation;


--
-- TOC entry 230 (class 1259 OID 139903)
-- Name: facteurproduction; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE facteurproduction (
    idfacteurproduction integer NOT NULL,
    nomfacteurproduction character varying(255) NOT NULL
);


ALTER TABLE facteurproduction OWNER TO postgres;

--
-- TOC entry 231 (class 1259 OID 139906)
-- Name: posseder_gestionnaire_facteurproduction; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE posseder_gestionnaire_facteurproduction (
    idgestionnairefacteurproduction integer NOT NULL,
    idgestionnaire integer NOT NULL,
    idfacteurproduction integer NOT NULL
);


ALTER TABLE posseder_gestionnaire_facteurproduction OWNER TO postgres;

--
-- TOC entry 232 (class 1259 OID 139909)
-- Name: facteurpargestionnaire; Type: VIEW; Schema: public; Owner: postgres
--

CREATE VIEW facteurpargestionnaire AS
 SELECT facteurproduction.nomfacteurproduction,
    posseder_gestionnaire_facteurproduction.idgestionnaire,
    posseder_gestionnaire_facteurproduction.idfacteurproduction
   FROM posseder_gestionnaire_facteurproduction,
    facteurproduction,
    gestionnaire
  WHERE ((posseder_gestionnaire_facteurproduction.idfacteurproduction = facteurproduction.idfacteurproduction) AND (gestionnaire.idgestionnaire = posseder_gestionnaire_facteurproduction.idgestionnaire));


ALTER TABLE facteurpargestionnaire OWNER TO postgres;

--
-- TOC entry 233 (class 1259 OID 139913)
-- Name: facteurproduction_idfacteurproduction_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE facteurproduction_idfacteurproduction_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE facteurproduction_idfacteurproduction_seq OWNER TO postgres;

--
-- TOC entry 2818 (class 0 OID 0)
-- Dependencies: 233
-- Name: facteurproduction_idfacteurproduction_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE facteurproduction_idfacteurproduction_seq OWNED BY facteurproduction.idfacteurproduction;


--
-- TOC entry 234 (class 1259 OID 139915)
-- Name: financer_bailleur_operateur; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE financer_bailleur_operateur (
    idbailleuroperateur integer NOT NULL,
    idoperateur integer NOT NULL,
    idbailleur integer NOT NULL,
    montantfinancement numeric NOT NULL,
    anneefinancement numeric,
    idprojet integer
);


ALTER TABLE financer_bailleur_operateur OWNER TO postgres;

--
-- TOC entry 235 (class 1259 OID 139921)
-- Name: filtreoperateurprojetparbailleur; Type: VIEW; Schema: public; Owner: postgres
--

CREATE VIEW filtreoperateurprojetparbailleur AS
 SELECT financer_bailleur_operateur.idoperateur,
    financer_bailleur_operateur.idbailleur,
    financer_bailleur_operateur.montantfinancement,
    financer_bailleur_operateur.anneefinancement,
    operateur.nomoperateur,
    operateur.nomcontactoperateur,
    financer_bailleur_operateur.idprojet,
    projet.nomprojet
   FROM financer_bailleur_operateur,
    operateur,
    projet
  WHERE ((financer_bailleur_operateur.idoperateur = operateur.idoperateur) AND (projet.idprojet = financer_bailleur_operateur.idprojet));


ALTER TABLE filtreoperateurprojetparbailleur OWNER TO postgres;

--
-- TOC entry 236 (class 1259 OID 139925)
-- Name: financer_bailleur_operateur_idbailleuroperateur_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE financer_bailleur_operateur_idbailleuroperateur_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE financer_bailleur_operateur_idbailleuroperateur_seq OWNER TO postgres;

--
-- TOC entry 2819 (class 0 OID 0)
-- Dependencies: 236
-- Name: financer_bailleur_operateur_idbailleuroperateur_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE financer_bailleur_operateur_idbailleuroperateur_seq OWNED BY financer_bailleur_operateur.idbailleuroperateur;


--
-- TOC entry 237 (class 1259 OID 139927)
-- Name: financer_bailleur_projet; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE financer_bailleur_projet (
    idbailleurprojet integer NOT NULL,
    idbailleur integer NOT NULL,
    idprojet integer NOT NULL,
    montantfinancement numeric,
    annee character varying(6)
);


ALTER TABLE financer_bailleur_projet OWNER TO postgres;

--
-- TOC entry 238 (class 1259 OID 139933)
-- Name: financer_bailleur_projet_idbailleurprojet_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE financer_bailleur_projet_idbailleurprojet_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE financer_bailleur_projet_idbailleurprojet_seq OWNER TO postgres;

--
-- TOC entry 2820 (class 0 OID 0)
-- Dependencies: 238
-- Name: financer_bailleur_projet_idbailleurprojet_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE financer_bailleur_projet_idbailleurprojet_seq OWNED BY financer_bailleur_projet.idbailleurprojet;


--
-- TOC entry 239 (class 1259 OID 139935)
-- Name: financerbailleuroperateur; Type: VIEW; Schema: public; Owner: postgres
--

CREATE VIEW financerbailleuroperateur AS
 SELECT financer_bailleur_operateur.idprojet,
    bailleur.idbailleur,
    bailleur.nombailleur,
    operateur.idoperateur,
    operateur.nomoperateur,
    financer_bailleur_operateur.montantfinancement,
    financer_bailleur_operateur.anneefinancement,
    financer_bailleur_operateur.idbailleuroperateur
   FROM financer_bailleur_operateur,
    bailleur,
    operateur
  WHERE ((financer_bailleur_operateur.idbailleur = bailleur.idbailleur) AND (financer_bailleur_operateur.idoperateur = operateur.idoperateur));


ALTER TABLE financerbailleuroperateur OWNER TO postgres;

--
-- TOC entry 240 (class 1259 OID 139939)
-- Name: financier; Type: VIEW; Schema: public; Owner: postgres
--

CREATE VIEW financier AS
 SELECT financer_bailleur_projet.idbailleurprojet,
    financer_bailleur_projet.idbailleur,
    financer_bailleur_projet.idprojet,
    financer_bailleur_projet.montantfinancement,
    financer_bailleur_projet.annee,
    bailleur.nombailleur
   FROM financer_bailleur_projet,
    bailleur
  WHERE (financer_bailleur_projet.idbailleur = bailleur.idbailleur);


ALTER TABLE financier OWNER TO postgres;

--
-- TOC entry 241 (class 1259 OID 139943)
-- Name: geomorphologie; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE geomorphologie (
    idtypegeomorphologie integer NOT NULL,
    nomtypegeomorphologie character varying(255) NOT NULL
);


ALTER TABLE geomorphologie OWNER TO postgres;

--
-- TOC entry 242 (class 1259 OID 139946)
-- Name: geomorphologie_idtypegeomorphologie_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE geomorphologie_idtypegeomorphologie_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE geomorphologie_idtypegeomorphologie_seq OWNER TO postgres;

--
-- TOC entry 2821 (class 0 OID 0)
-- Dependencies: 242
-- Name: geomorphologie_idtypegeomorphologie_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE geomorphologie_idtypegeomorphologie_seq OWNED BY geomorphologie.idtypegeomorphologie;


--
-- TOC entry 243 (class 1259 OID 139948)
-- Name: gestionnaire_idgestionnaire_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE gestionnaire_idgestionnaire_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE gestionnaire_idgestionnaire_seq OWNER TO postgres;

--
-- TOC entry 2822 (class 0 OID 0)
-- Dependencies: 243
-- Name: gestionnaire_idgestionnaire_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE gestionnaire_idgestionnaire_seq OWNED BY gestionnaire.idgestionnaire;


--
-- TOC entry 244 (class 1259 OID 139950)
-- Name: localite_idlocalite_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE localite_idlocalite_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE localite_idlocalite_seq OWNER TO postgres;

--
-- TOC entry 2823 (class 0 OID 0)
-- Dependencies: 244
-- Name: localite_idlocalite_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE localite_idlocalite_seq OWNED BY localite.idlocalite;


--
-- TOC entry 245 (class 1259 OID 139952)
-- Name: observer_collecteur_site; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE observer_collecteur_site (
    idcollecteursite integer NOT NULL,
    idcollecteur integer NOT NULL,
    idsite integer NOT NULL,
    dateobservation date NOT NULL,
    numerofiche character varying(255) DEFAULT NULL::character varying
);


ALTER TABLE observer_collecteur_site OWNER TO postgres;

--
-- TOC entry 246 (class 1259 OID 139956)
-- Name: observer_collecteur_site_idcollecteursite_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE observer_collecteur_site_idcollecteursite_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE observer_collecteur_site_idcollecteursite_seq OWNER TO postgres;

--
-- TOC entry 2824 (class 0 OID 0)
-- Dependencies: 246
-- Name: observer_collecteur_site_idcollecteursite_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE observer_collecteur_site_idcollecteursite_seq OWNED BY observer_collecteur_site.idcollecteursite;


--
-- TOC entry 247 (class 1259 OID 139958)
-- Name: vuecollection; Type: VIEW; Schema: public; Owner: postgres
--

CREATE VIEW vuecollection AS
 SELECT collecteur.nomcollecteur,
    collecteur.prenomcollecteur,
    collecteur.fonctioncollecteur,
    collecteur.numcollecteur,
    collecteur.emailcollecteur,
    collecteur.idcollecteur,
    observer_collecteur_site.dateobservation,
    observer_collecteur_site.numerofiche,
    site.nomsite,
    site.superficiesite,
    site.idsite,
    observer_collecteur_site.idcollecteursite
   FROM site,
    collecteur,
    observer_collecteur_site
  WHERE ((site.idsite = observer_collecteur_site.idsite) AND (collecteur.idcollecteur = observer_collecteur_site.idcollecteur));


ALTER TABLE vuecollection OWNER TO postgres;

--
-- TOC entry 248 (class 1259 OID 139962)
-- Name: observersite; Type: VIEW; Schema: public; Owner: postgres
--

CREATE VIEW observersite AS
 SELECT vuecollection.nomcollecteur,
    vuecollection.prenomcollecteur,
    vuecollection.fonctioncollecteur,
    vuecollection.numcollecteur,
    vuecollection.emailcollecteur,
    vuecollection.idcollecteur,
    vuecollection.dateobservation,
    vuecollection.numerofiche,
    vuecollection.nomsite,
    vuecollection.superficiesite,
    vuecollection.idsite,
    vuecollection.idcollecteursite,
    localite.idlocalite,
    localite.nomlocalite,
    commune.idcommune,
    commune.nomcommune,
    province.idprovince,
    province.nomprovince,
    region.nomregion,
    region.idregion
   FROM vuecollection,
    site,
    localite,
    commune,
    province,
    region
  WHERE ((vuecollection.idsite = site.idsite) AND (site.idlocalite = localite.idlocalite) AND (localite.idcommune = commune.idcommune) AND (commune.idprovince = province.idprovince) AND (region.idregion = province.idregion));


ALTER TABLE observersite OWNER TO postgres;

--
-- TOC entry 249 (class 1259 OID 139967)
-- Name: operateur_idoperateur_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE operateur_idoperateur_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE operateur_idoperateur_seq OWNER TO postgres;

--
-- TOC entry 2825 (class 0 OID 0)
-- Dependencies: 249
-- Name: operateur_idoperateur_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE operateur_idoperateur_seq OWNED BY operateur.idoperateur;


--
-- TOC entry 250 (class 1259 OID 139969)
-- Name: posseder_gestionnaire_facteur_idgestionnairefacteurproducti_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE posseder_gestionnaire_facteur_idgestionnairefacteurproducti_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE posseder_gestionnaire_facteur_idgestionnairefacteurproducti_seq OWNER TO postgres;

--
-- TOC entry 2826 (class 0 OID 0)
-- Dependencies: 250
-- Name: posseder_gestionnaire_facteur_idgestionnairefacteurproducti_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE posseder_gestionnaire_facteur_idgestionnairefacteurproducti_seq OWNED BY posseder_gestionnaire_facteurproduction.idgestionnairefacteurproduction;


--
-- TOC entry 251 (class 1259 OID 139971)
-- Name: projet_idprojet_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE projet_idprojet_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE projet_idprojet_seq OWNER TO postgres;

--
-- TOC entry 2827 (class 0 OID 0)
-- Dependencies: 251
-- Name: projet_idprojet_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE projet_idprojet_seq OWNED BY projet.idprojet;


--
-- TOC entry 252 (class 1259 OID 139973)
-- Name: province_idprovince_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE province_idprovince_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE province_idprovince_seq OWNER TO postgres;

--
-- TOC entry 2828 (class 0 OID 0)
-- Dependencies: 252
-- Name: province_idprovince_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE province_idprovince_seq OWNED BY province.idprovince;


--
-- TOC entry 253 (class 1259 OID 139975)
-- Name: recevoir_appui_gest_op_idappuigestop_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE recevoir_appui_gest_op_idappuigestop_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE recevoir_appui_gest_op_idappuigestop_seq OWNER TO postgres;

--
-- TOC entry 2829 (class 0 OID 0)
-- Dependencies: 253
-- Name: recevoir_appui_gest_op_idappuigestop_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE recevoir_appui_gest_op_idappuigestop_seq OWNED BY recevoir_appui_gest_op.idappuigestop;


--
-- TOC entry 254 (class 1259 OID 139977)
-- Name: reconnaissance; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE reconnaissance (
    idreconnaissance integer NOT NULL,
    libelle character varying(255)
);


ALTER TABLE reconnaissance OWNER TO postgres;

--
-- TOC entry 255 (class 1259 OID 139980)
-- Name: reconnaissance_idreconnaissance_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE reconnaissance_idreconnaissance_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE reconnaissance_idreconnaissance_seq OWNER TO postgres;

--
-- TOC entry 2830 (class 0 OID 0)
-- Dependencies: 255
-- Name: reconnaissance_idreconnaissance_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE reconnaissance_idreconnaissance_seq OWNED BY reconnaissance.idreconnaissance;


--
-- TOC entry 256 (class 1259 OID 139982)
-- Name: region_idregion_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE region_idregion_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE region_idregion_seq OWNER TO postgres;

--
-- TOC entry 2831 (class 0 OID 0)
-- Dependencies: 256
-- Name: region_idregion_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE region_idregion_seq OWNED BY region.idregion;


--
-- TOC entry 257 (class 1259 OID 139984)
-- Name: requete1; Type: VIEW; Schema: public; Owner: postgres
--

CREATE VIEW requete1 AS
 SELECT localite.nomlocalite,
    region.idregion,
    region.nomregion,
    province.nomprovince,
    province.idprovince,
    commune.nbremenage,
    commune.totalpopulation,
    commune.nbrefemme,
    commune.nbrehomme,
    commune.nomcommune,
    commune.idcommune,
    site.idsite,
    localite.idlocalite,
    amenager.idprojet,
    amenager.periodefin,
    amenager.periodedebut,
    amenager.superficieciblee,
    amenager.idoperateur,
    amenager.idamenagement,
    amenagement.infosspec,
    amenagement.souscategorieamenagement,
    amenagement.nomamenagement,
    categorieamenagement.nomcategorieamenagement,
    categorieamenagement.idcategorieamenagement,
    amenager.typemesuresite
   FROM region,
    province,
    commune,
    localite,
    amenagement,
    amenager,
    site,
    categorieamenagement
  WHERE ((region.idregion = province.idregion) AND (commune.idprovince = province.idprovince) AND (localite.idcommune = commune.idcommune) AND (localite.idlocalite = site.idlocalite) AND (amenagement.idamenagement = amenager.idamenagement) AND (amenager.idsite = site.idsite) AND (categorieamenagement.idcategorieamenagement = amenagement.idcategorieamenagement));


ALTER TABLE requete1 OWNER TO postgres;

--
-- TOC entry 258 (class 1259 OID 139989)
-- Name: revenuannuel; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE revenuannuel (
    idrevenuannuel integer NOT NULL,
    idgestionnaire integer NOT NULL,
    montantrevenuannuel numeric NOT NULL,
    anneerevenuannuel numeric
);


ALTER TABLE revenuannuel OWNER TO postgres;

--
-- TOC entry 259 (class 1259 OID 139995)
-- Name: requete10; Type: VIEW; Schema: public; Owner: postgres
--

CREATE VIEW requete10 AS
 SELECT gestionnaire.typegestionnaire,
    gestionnaire.idgestionnaire,
    gestionnaire.nomgestionnaire,
    gestionnaire.prenomgestionnaire,
    gestionnaire.numgestionnaire,
    gestionnaire.emailgestionnaire,
    revenuannuel.montantrevenuannuel,
    revenuannuel.anneerevenuannuel
   FROM gestionnaire,
    revenuannuel
  WHERE (gestionnaire.idgestionnaire = revenuannuel.idgestionnaire);


ALTER TABLE requete10 OWNER TO postgres;

--
-- TOC entry 260 (class 1259 OID 139999)
-- Name: vocation; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE vocation (
    idvocation integer NOT NULL,
    idcategorievocation integer NOT NULL,
    nomvocation character varying(255) NOT NULL
);


ALTER TABLE vocation OWNER TO postgres;

--
-- TOC entry 261 (class 1259 OID 140002)
-- Name: requete12; Type: VIEW; Schema: public; Owner: postgres
--

CREATE VIEW requete12 AS
 SELECT province.idprovince,
    province.nomprovince,
    categorievocation.idcategorievocation,
    categorievocation.nomcategorievocation,
    commune.idcommune,
    commune.nomcommune,
    region.idregion,
    region.nomregion,
    localite.idlocalite,
    localite.nomlocalite,
    vocation.idvocation,
    vocation.nomvocation,
    site.superficiesite,
    site.nomsite,
    site.typemesuresite
   FROM categorievocation,
    commune,
    localite,
    province,
    region,
    site,
    vocation
  WHERE ((commune.idcommune = localite.idcommune) AND (province.idprovince = commune.idprovince) AND (region.idregion = province.idregion) AND (site.idvocation = vocation.idvocation) AND (site.idlocalite = localite.idlocalite) AND (vocation.idcategorievocation = categorievocation.idcategorievocation));


ALTER TABLE requete12 OWNER TO postgres;

--
-- TOC entry 262 (class 1259 OID 140007)
-- Name: vegetalisation; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE vegetalisation (
    idvegetalisation integer NOT NULL,
    typevegetalisation character varying(255) NOT NULL,
    descriptionvegetalisation text
);


ALTER TABLE vegetalisation OWNER TO postgres;

--
-- TOC entry 263 (class 1259 OID 140013)
-- Name: requete13; Type: VIEW; Schema: public; Owner: postgres
--

CREATE VIEW requete13 AS
 SELECT commune.idcommune,
    commune.nomcommune,
    localite.idlocalite,
    localite.nomlocalite,
    province.idprovince,
    province.nomprovince,
    region.idregion,
    region.nomregion,
    site.idsite,
    site.nomsite,
    site.superficiesite,
    amenager.superficieciblee,
    amenager.periodedebut,
    amenager.periodefin,
    amenager.idamenager,
    amenager_espece.tauxreprise,
    amenager_espece.tauxsurvie,
    amenager_espece.quantitesemis,
    amenager_espece.nbreplant,
    espece.idespece,
    espece.nomespece,
    amenager_vegetalisation.idvegetalisation,
    vegetalisation.typevegetalisation,
    amenager.typemesuresite
   FROM amenager,
    amenager_espece,
    amenager_vegetalisation,
    commune,
    espece,
    localite,
    province,
    region,
    site,
    vegetalisation
  WHERE ((amenager.idamenager = amenager_espece.idamenager) AND (amenager.idamenager = amenager_vegetalisation.idamenager) AND (amenager_espece.idespece = espece.idespece) AND (amenager_vegetalisation.idvegetalisation = vegetalisation.idvegetalisation) AND (commune.idcommune = localite.idcommune) AND (localite.idlocalite = site.idlocalite) AND (province.idprovince = commune.idprovince) AND (region.idregion = province.idregion) AND (site.idsite = amenager.idsite));


ALTER TABLE requete13 OWNER TO postgres;

--
-- TOC entry 264 (class 1259 OID 140018)
-- Name: requete2; Type: VIEW; Schema: public; Owner: postgres
--

CREATE VIEW requete2 AS
 SELECT amenager.superficieciblee,
    amenager.periodedebut,
    amenager.periodefin,
    amenager.idprojet,
    site.nomsite,
    site.superficiesite,
    site.idsite,
    localite.nomlocalite,
    commune.nomcommune,
    commune.idcommune,
    operateur.nomoperateur,
    operateur.idoperateur,
    amenagement.nomamenagement,
    amenagement.idamenagement,
    categorieamenagement.idcategorieamenagement,
    categorieamenagement.nomcategorieamenagement,
    province.nomprovince,
    province.idprovince,
    region.nomregion,
    region.idregion,
    localite.idlocalite
   FROM amenager,
    commune,
    localite,
    operateur,
    site,
    amenagement,
    categorieamenagement,
    province,
    region
  WHERE ((amenager.idsite = site.idsite) AND (commune.idcommune = localite.idcommune) AND (operateur.idoperateur = amenager.idoperateur) AND (site.idlocalite = localite.idlocalite) AND (amenagement.idamenagement = amenager.idamenagement) AND (categorieamenagement.idcategorieamenagement = amenagement.idcategorieamenagement) AND (province.idprovince = commune.idprovince) AND (region.idregion = province.idregion));


ALTER TABLE requete2 OWNER TO postgres;

--
-- TOC entry 265 (class 1259 OID 140023)
-- Name: requete4; Type: VIEW; Schema: public; Owner: postgres
--

CREATE VIEW requete4 AS
 SELECT requete2.superficieciblee,
    requete2.periodedebut,
    requete2.periodefin,
    requete2.idprojet,
    requete2.nomsite,
    requete2.superficiesite,
    requete2.idsite,
    requete2.nomlocalite,
    requete2.nomcommune,
    requete2.idcommune,
    requete2.nomoperateur,
    requete2.idoperateur,
    requete2.nomamenagement,
    requete2.idamenagement,
    requete2.idcategorieamenagement,
    requete2.nomcategorieamenagement,
    requete2.nomprovince,
    requete2.idprovince,
    requete2.nomregion,
    requete2.idregion,
    financer_bailleur_operateur.montantfinancement,
    financer_bailleur_operateur.anneefinancement,
    bailleur.nombailleur,
    bailleur.idbailleur,
    requete2.idlocalite
   FROM bailleur,
    financer_bailleur_operateur,
    requete2
  WHERE ((financer_bailleur_operateur.idbailleur = bailleur.idbailleur) AND (requete2.idoperateur = financer_bailleur_operateur.idoperateur) AND (requete2.idprojet = financer_bailleur_operateur.idprojet));


ALTER TABLE requete4 OWNER TO postgres;

--
-- TOC entry 266 (class 1259 OID 140028)
-- Name: requete6; Type: VIEW; Schema: public; Owner: postgres
--

CREATE VIEW requete6 AS
 SELECT projet.nomprojet,
    projet.idprojet,
    projet.budgetglobal,
    projet.budgetgmv,
    projet.datedebutprojet,
    projet.datefinprojet,
    projet.nomcontactprojet,
    projet.prenomcontactprojet,
    projet.numcontactprojet,
    projet.emailcontactprojet,
    projet.siteinternetprojet,
    projet.descriptionprojet,
    bailleur.idbailleur,
    bailleur.nombailleur,
    bailleur.nomcontactbailleur,
    bailleur.prenomcontactbailleur,
    bailleur.numcontactbailleur,
    bailleur.emailcontactbailleur,
    bailleur.descriptionbailleur,
    financer_bailleur_projet.annee,
    financer_bailleur_projet.montantfinancement
   FROM bailleur,
    projet,
    financer_bailleur_projet
  WHERE ((bailleur.idbailleur = financer_bailleur_projet.idbailleur) AND (projet.idprojet = financer_bailleur_projet.idprojet));


ALTER TABLE requete6 OWNER TO postgres;

--
-- TOC entry 267 (class 1259 OID 140033)
-- Name: requete7; Type: VIEW; Schema: public; Owner: postgres
--

CREATE VIEW requete7 AS
 SELECT province.nomprovince,
    province.idprovince,
    region.idregion,
    region.nomregion,
    localite.nomlocalite,
    localite.idlocalite,
    commune.idcommune,
    commune.nomcommune,
    site.idsite,
    site.nomsite,
    site.superficiesite,
    amenager.idamenager,
    amenager.superficieciblee,
    amenager.periodedebut,
    amenager.periodefin,
    operateur.idoperateur,
    operateur.nomoperateur,
    operateur.nomcontactoperateur,
    operateur.prenomcontactoperateur,
    operateur.emailcontactoperateur,
    operateur.numcontactoperateur,
    operateur.fonctioncontactoperateur,
    bailleur.idbailleur,
    bailleur.nombailleur,
    bailleur.nomcontactbailleur,
    bailleur.prenomcontactbailleur,
    bailleur.numcontactbailleur,
    bailleur.emailcontactbailleur,
    financer_bailleur_operateur.montantfinancement,
    financer_bailleur_operateur.anneefinancement
   FROM operateur,
    financer_bailleur_operateur,
    site,
    amenager,
    commune,
    localite,
    province,
    region,
    bailleur
  WHERE ((operateur.idoperateur = amenager.idoperateur) AND (operateur.idoperateur = financer_bailleur_operateur.idoperateur) AND (site.idsite = amenager.idsite) AND (commune.idcommune = localite.idcommune) AND (localite.idlocalite = site.idlocalite) AND (province.idprovince = commune.idprovince) AND (region.idregion = province.idregion) AND (bailleur.idbailleur = financer_bailleur_operateur.idbailleur));


ALTER TABLE requete7 OWNER TO postgres;

--
-- TOC entry 268 (class 1259 OID 140038)
-- Name: requete8; Type: VIEW; Schema: public; Owner: postgres
--

CREATE VIEW requete8 AS
 SELECT region.nomregion,
    province.nomprovince,
    commune.nomcommune,
    commune.idcommune,
    projet.idprojet,
    projet.nomprojet,
    projet.datedebutprojet,
    projet.datefinprojet,
    province.idprovince,
    region.idregion
   FROM commune,
    projet,
    region,
    province,
    executer_projet_commune
  WHERE ((commune.idcommune = executer_projet_commune.idcommune) AND (province.idregion = region.idregion) AND (province.idprovince = commune.idprovince) AND (executer_projet_commune.idprojet = projet.idprojet));


ALTER TABLE requete8 OWNER TO postgres;

--
-- TOC entry 269 (class 1259 OID 140042)
-- Name: requete9; Type: VIEW; Schema: public; Owner: postgres
--

CREATE VIEW requete9 AS
 SELECT site.nomsite,
    site.superficiesite,
    commune.idcommune,
    commune.nomcommune,
    region.idregion,
    region.nomregion,
    province.idprovince,
    province.nomprovince,
    localite.idlocalite,
    localite.nomlocalite,
    appuigestop.datedebutappui,
    appuigestop.datefinappui,
    appuigestop.idoperateur,
    appuigestop.nomoperateur,
    appuigestop.idgestionnaire,
    appuigestop.typegestionnaire,
    appuigestop.nomgestionnaire,
    appuigestop.prenomgestionnaire,
    appuigestop.nomcollectif,
    appuigestop.typeappui,
    appuigestop.idappui,
    projet.idprojet,
    projet.nomprojet
   FROM appuigestop,
    site,
    region,
    localite,
    province,
    commune,
    projet
  WHERE ((appuigestop.idgestionnaire = site.idgestionnaire) AND (site.idlocalite = localite.idlocalite) AND (province.idprovince = commune.idprovince) AND (province.idregion = region.idregion) AND (commune.idcommune = localite.idcommune) AND (projet.idprojet = appuigestop.idprojet));


ALTER TABLE requete9 OWNER TO postgres;

--
-- TOC entry 270 (class 1259 OID 140047)
-- Name: revenuannuel_idrevenuannuel_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE revenuannuel_idrevenuannuel_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE revenuannuel_idrevenuannuel_seq OWNER TO postgres;

--
-- TOC entry 2832 (class 0 OID 0)
-- Dependencies: 270
-- Name: revenuannuel_idrevenuannuel_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE revenuannuel_idrevenuannuel_seq OWNED BY revenuannuel.idrevenuannuel;


--
-- TOC entry 271 (class 1259 OID 140049)
-- Name: site_idsite_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE site_idsite_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE site_idsite_seq OWNER TO postgres;

--
-- TOC entry 2833 (class 0 OID 0)
-- Dependencies: 271
-- Name: site_idsite_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE site_idsite_seq OWNED BY site.idsite;


--
-- TOC entry 272 (class 1259 OID 140051)
-- Name: souscategorie; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE souscategorie (
    idsouscategorie integer NOT NULL,
    libelle character varying(255)
);


ALTER TABLE souscategorie OWNER TO postgres;

--
-- TOC entry 273 (class 1259 OID 140054)
-- Name: souscategorie_idsouscategorie_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE souscategorie_idsouscategorie_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE souscategorie_idsouscategorie_seq OWNER TO postgres;

--
-- TOC entry 2834 (class 0 OID 0)
-- Dependencies: 273
-- Name: souscategorie_idsouscategorie_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE souscategorie_idsouscategorie_seq OWNED BY souscategorie.idsouscategorie;


--
-- TOC entry 274 (class 1259 OID 140056)
-- Name: statutfoncier; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE statutfoncier (
    idstatutfoncier integer NOT NULL,
    typereconnaissance character varying(255) NOT NULL,
    typeexploitation character varying(255) NOT NULL
);


ALTER TABLE statutfoncier OWNER TO postgres;

--
-- TOC entry 275 (class 1259 OID 140062)
-- Name: statutfoncier_idstatutfoncier_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE statutfoncier_idstatutfoncier_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE statutfoncier_idstatutfoncier_seq OWNER TO postgres;

--
-- TOC entry 2835 (class 0 OID 0)
-- Dependencies: 275
-- Name: statutfoncier_idstatutfoncier_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE statutfoncier_idstatutfoncier_seq OWNED BY statutfoncier.idstatutfoncier;


--
-- TOC entry 276 (class 1259 OID 140064)
-- Name: typecollectif; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE typecollectif (
    idtype integer NOT NULL,
    libelle character varying(255)
);


ALTER TABLE typecollectif OWNER TO postgres;

--
-- TOC entry 277 (class 1259 OID 140067)
-- Name: typecollectif_idtype_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE typecollectif_idtype_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE typecollectif_idtype_seq OWNER TO postgres;

--
-- TOC entry 2836 (class 0 OID 0)
-- Dependencies: 277
-- Name: typecollectif_idtype_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE typecollectif_idtype_seq OWNED BY typecollectif.idtype;


--
-- TOC entry 278 (class 1259 OID 140069)
-- Name: typesol; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE typesol (
    idtypesol integer NOT NULL,
    nomtypesol character varying(255) NOT NULL
);


ALTER TABLE typesol OWNER TO postgres;

--
-- TOC entry 279 (class 1259 OID 140072)
-- Name: typesol_idtypesol_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE typesol_idtypesol_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE typesol_idtypesol_seq OWNER TO postgres;

--
-- TOC entry 2837 (class 0 OID 0)
-- Dependencies: 279
-- Name: typesol_idtypesol_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE typesol_idtypesol_seq OWNED BY typesol.idtypesol;


--
-- TOC entry 280 (class 1259 OID 140074)
-- Name: users; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE users (
    iduser integer NOT NULL,
    nom character varying(255),
    prenom character varying(255),
    fonction character varying(255),
    service character varying(255),
    telephone character varying(50),
    email character varying(255),
    identifiant character varying(255),
    motdepasse text,
    profil integer
);


ALTER TABLE users OWNER TO postgres;

--
-- TOC entry 281 (class 1259 OID 140080)
-- Name: user_iduser_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE user_iduser_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE user_iduser_seq OWNER TO postgres;

--
-- TOC entry 2838 (class 0 OID 0)
-- Dependencies: 281
-- Name: user_iduser_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE user_iduser_seq OWNED BY users.iduser;


--
-- TOC entry 282 (class 1259 OID 140082)
-- Name: vegetalisation_idvegetalisation_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE vegetalisation_idvegetalisation_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE vegetalisation_idvegetalisation_seq OWNER TO postgres;

--
-- TOC entry 2839 (class 0 OID 0)
-- Dependencies: 282
-- Name: vegetalisation_idvegetalisation_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE vegetalisation_idvegetalisation_seq OWNED BY vegetalisation.idvegetalisation;


--
-- TOC entry 283 (class 1259 OID 140084)
-- Name: vocation_idvocation_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE vocation_idvocation_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE vocation_idvocation_seq OWNER TO postgres;

--
-- TOC entry 2840 (class 0 OID 0)
-- Dependencies: 283
-- Name: vocation_idvocation_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE vocation_idvocation_seq OWNED BY vocation.idvocation;


--
-- TOC entry 284 (class 1259 OID 140086)
-- Name: vuecommune; Type: VIEW; Schema: public; Owner: postgres
--

CREATE VIEW vuecommune AS
 SELECT commune.idcommune,
    commune.idprovince,
    commune.nomcommune,
    commune.nbrehomme,
    commune.nbrefemme,
    commune.totalpopulation,
    commune.nbremenage
   FROM commune;


ALTER TABLE vuecommune OWNER TO postgres;

--
-- TOC entry 285 (class 1259 OID 140090)
-- Name: vuegestionnairecollectif; Type: VIEW; Schema: public; Owner: postgres
--

CREATE VIEW vuegestionnairecollectif AS
 SELECT gestionnaire.idgestionnaire,
    gestionnaire.typegestionnaire,
    gestionnaire.nomgestionnaire,
    gestionnaire.prenomgestionnaire,
    gestionnaire.numgestionnaire,
    gestionnaire.emailgestionnaire,
    gestionnaire.nomcollectif,
    gestionnaire.genrecollectif,
    gestionnaire.typecollectif,
    gestionnaire.nbremembrecollectif
   FROM gestionnaire
  WHERE ((gestionnaire.typegestionnaire)::text = 'collectif'::text);


ALTER TABLE vuegestionnairecollectif OWNER TO postgres;

--
-- TOC entry 286 (class 1259 OID 140094)
-- Name: vuegestionnaireindividuel; Type: VIEW; Schema: public; Owner: postgres
--

CREATE VIEW vuegestionnaireindividuel AS
 SELECT gestionnaire.idgestionnaire,
    gestionnaire.typegestionnaire,
    gestionnaire.nomgestionnaire,
    gestionnaire.prenomgestionnaire,
    gestionnaire.numgestionnaire,
    gestionnaire.emailgestionnaire,
    gestionnaire.datenaissance,
    gestionnaire.sexe AS statutmarital,
    gestionnaire.nbrepersonnemenage,
    gestionnaire.nbrepersonnemoinsseizeans
   FROM gestionnaire
  WHERE ((gestionnaire.typegestionnaire)::text = 'individuel'::text);


ALTER TABLE vuegestionnaireindividuel OWNER TO postgres;

--
-- TOC entry 287 (class 1259 OID 140098)
-- Name: vuelocalite; Type: VIEW; Schema: public; Owner: postgres
--

CREATE VIEW vuelocalite AS
 SELECT localite.idlocalite,
    localite.idcommune,
    localite.nomlocalite
   FROM localite;


ALTER TABLE vuelocalite OWNER TO postgres;

--
-- TOC entry 288 (class 1259 OID 140102)
-- Name: vueoperateurgestionnaireappui; Type: VIEW; Schema: public; Owner: postgres
--

CREATE VIEW vueoperateurgestionnaireappui AS
 SELECT operateur.nomoperateur,
    operateur.nomcontactoperateur,
    operateur.prenomcontactoperateur,
    operateur.emailcontactoperateur,
    operateur.numcontactoperateur,
    operateur.fonctioncontactoperateur,
    operateur.siteinternetoperateur,
    gestionnaire.typegestionnaire,
    gestionnaire.nomgestionnaire,
    gestionnaire.prenomgestionnaire,
    gestionnaire.numgestionnaire,
    gestionnaire.emailgestionnaire,
    gestionnaire.datenaissance,
    gestionnaire.sexe AS statutmarital,
    gestionnaire.nbrepersonnemenage,
    gestionnaire.nbrepersonnemoinsseizeans,
    gestionnaire.nomcollectif,
    gestionnaire.genrecollectif,
    gestionnaire.typecollectif,
    gestionnaire.nbremembrecollectif,
    appui.typeappui,
    recevoir_appui_gest_op.idappuigestop,
    recevoir_appui_gest_op.datedebutappui,
    recevoir_appui_gest_op.datefinappui,
    recevoir_appui_gest_op.nbrebeneficiaire,
    recevoir_appui_gest_op.descriptionappui,
    recevoir_appui_gest_op.exploitationpfnl
   FROM appui,
    gestionnaire,
    recevoir_appui_gest_op,
    operateur
  WHERE ((appui.idappui = recevoir_appui_gest_op.idappui) AND (gestionnaire.idgestionnaire = recevoir_appui_gest_op.idgestionnaire) AND (operateur.idoperateur = recevoir_appui_gest_op.idoperateur));


ALTER TABLE vueoperateurgestionnaireappui OWNER TO postgres;

--
-- TOC entry 289 (class 1259 OID 140107)
-- Name: vueprovince; Type: VIEW; Schema: public; Owner: postgres
--

CREATE VIEW vueprovince AS
 SELECT province.idprovince,
    province.idregion,
    province.nomprovince
   FROM province;


ALTER TABLE vueprovince OWNER TO postgres;

--
-- TOC entry 290 (class 1259 OID 140111)
-- Name: vueregion; Type: VIEW; Schema: public; Owner: postgres
--

CREATE VIEW vueregion AS
 SELECT region.idregion,
    region.nomregion
   FROM region;


ALTER TABLE vueregion OWNER TO postgres;

--
-- TOC entry 291 (class 1259 OID 140115)
-- Name: vuerevenuannuelgestionnaire; Type: VIEW; Schema: public; Owner: postgres
--

CREATE VIEW vuerevenuannuelgestionnaire AS
 SELECT gestionnaire.typegestionnaire,
    gestionnaire.nomgestionnaire,
    gestionnaire.prenomgestionnaire,
    gestionnaire.numgestionnaire,
    gestionnaire.emailgestionnaire,
    gestionnaire.idgestionnaire,
    revenuannuel.montantrevenuannuel,
    revenuannuel.anneerevenuannuel,
    revenuannuel.idrevenuannuel
   FROM gestionnaire,
    revenuannuel
  WHERE (gestionnaire.idgestionnaire = revenuannuel.idgestionnaire);


ALTER TABLE vuerevenuannuelgestionnaire OWNER TO postgres;

--
-- TOC entry 292 (class 1259 OID 140119)
-- Name: vuesite; Type: VIEW; Schema: public; Owner: postgres
--

CREATE VIEW vuesite AS
 SELECT site.idsite,
    site.idlocalite,
    site.idgestionnaire,
    site.idstatutfoncier,
    site.idvocation,
    site.nomsite,
    site.superficiesite
   FROM site;


ALTER TABLE vuesite OWNER TO postgres;

--
-- TOC entry 293 (class 1259 OID 140123)
-- Name: vuesitelocalitestatusgestionnaire; Type: VIEW; Schema: public; Owner: postgres
--

CREATE VIEW vuesitelocalitestatusgestionnaire AS
 SELECT site.idsite,
    site.nomsite,
    site.superficiesite,
    gestionnaire.typegestionnaire,
    gestionnaire.nomgestionnaire,
    gestionnaire.prenomgestionnaire,
    site.idgestionnaire,
    site.idstatutfoncier,
    gestionnaire.numgestionnaire,
    gestionnaire.emailgestionnaire,
    statutfoncier.typereconnaissance,
    statutfoncier.typeexploitation,
    vocation.idcategorievocation,
    vocation.nomvocation,
    site.idvocation,
    site.idlocalite,
    localite.nomlocalite,
    localite.idcommune,
    site.typemesuresite
   FROM site,
    gestionnaire,
    statutfoncier,
    vocation,
    localite
  WHERE ((site.idvocation = vocation.idvocation) AND (site.idgestionnaire = gestionnaire.idgestionnaire) AND (site.idstatutfoncier = statutfoncier.idstatutfoncier) AND (localite.idlocalite = site.idlocalite));


ALTER TABLE vuesitelocalitestatusgestionnaire OWNER TO postgres;

--
-- TOC entry 294 (class 1259 OID 140128)
-- Name: vuesitelocalitestatusgestionnaireplus; Type: VIEW; Schema: public; Owner: postgres
--

CREATE VIEW vuesitelocalitestatusgestionnaireplus AS
 SELECT vuesitelocalitestatusgestionnaire.idsite,
    vuesitelocalitestatusgestionnaire.nomsite,
    vuesitelocalitestatusgestionnaire.superficiesite,
    vuesitelocalitestatusgestionnaire.typegestionnaire,
    vuesitelocalitestatusgestionnaire.nomgestionnaire,
    vuesitelocalitestatusgestionnaire.prenomgestionnaire,
    vuesitelocalitestatusgestionnaire.idgestionnaire,
    vuesitelocalitestatusgestionnaire.idstatutfoncier,
    vuesitelocalitestatusgestionnaire.numgestionnaire,
    vuesitelocalitestatusgestionnaire.emailgestionnaire,
    vuesitelocalitestatusgestionnaire.typereconnaissance,
    vuesitelocalitestatusgestionnaire.typeexploitation,
    vuesitelocalitestatusgestionnaire.idcategorievocation,
    vuesitelocalitestatusgestionnaire.nomvocation,
    vuesitelocalitestatusgestionnaire.idvocation,
    vuesitelocalitestatusgestionnaire.idlocalite,
    vuesitelocalitestatusgestionnaire.nomlocalite,
    vuesitelocalitestatusgestionnaire.idcommune,
    commune.idprovince,
    commune.nomcommune,
    province.idregion,
    province.nomprovince,
    region.nomregion,
    vuesitelocalitestatusgestionnaire.typemesuresite
   FROM vuesitelocalitestatusgestionnaire,
    commune,
    province,
    region
  WHERE ((vuesitelocalitestatusgestionnaire.idcommune = commune.idcommune) AND (commune.idprovince = province.idprovince) AND (province.idregion = region.idregion));


ALTER TABLE vuesitelocalitestatusgestionnaireplus OWNER TO postgres;

--
-- TOC entry 2373 (class 2604 OID 140133)
-- Name: idamenagement; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY amenagement ALTER COLUMN idamenagement SET DEFAULT nextval('amenagement_idamenagement_seq'::regclass);


--
-- TOC entry 2374 (class 2604 OID 140134)
-- Name: idamenager; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY amenager ALTER COLUMN idamenager SET DEFAULT nextval('amenager_idamenager_seq'::regclass);


--
-- TOC entry 2375 (class 2604 OID 140135)
-- Name: idamenagerespece; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY amenager_espece ALTER COLUMN idamenagerespece SET DEFAULT nextval('amenager_espece_idamenagerespece_seq'::regclass);


--
-- TOC entry 2376 (class 2604 OID 140136)
-- Name: idamenagervegetalisation; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY amenager_vegetalisation ALTER COLUMN idamenagervegetalisation SET DEFAULT nextval('amenager_vegetalisation_idamenagervegetalisation_seq'::regclass);


--
-- TOC entry 2387 (class 2604 OID 140137)
-- Name: idappui; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY appui ALTER COLUMN idappui SET DEFAULT nextval('appui_idappui_seq'::regclass);


--
-- TOC entry 2393 (class 2604 OID 140138)
-- Name: idbailleur; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY bailleur ALTER COLUMN idbailleur SET DEFAULT nextval('bailleur_idbailleur_seq'::regclass);


--
-- TOC entry 2394 (class 2604 OID 140139)
-- Name: idcategorieamenagement; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY categorieamenagement ALTER COLUMN idcategorieamenagement SET DEFAULT nextval('categorieamenagement_idcategorieamenagement_seq'::regclass);


--
-- TOC entry 2395 (class 2604 OID 140140)
-- Name: idcategorievocation; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY categorievocation ALTER COLUMN idcategorievocation SET DEFAULT nextval('categorievocation_idcategorievocation_seq'::regclass);


--
-- TOC entry 2399 (class 2604 OID 140141)
-- Name: idcollecteur; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY collecteur ALTER COLUMN idcollecteur SET DEFAULT nextval('collecteur_idcollecteur_seq'::regclass);


--
-- TOC entry 2400 (class 2604 OID 140142)
-- Name: idcommune; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY commune ALTER COLUMN idcommune SET DEFAULT nextval('commune_idcommune_seq'::regclass);


--
-- TOC entry 2401 (class 2604 OID 140143)
-- Name: idsitegeomorphologie; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY correspondre_site_geomorphologie ALTER COLUMN idsitegeomorphologie SET DEFAULT nextval('correspondre_site_geomorphologie_idsitegeomorphologie_seq'::regclass);


--
-- TOC entry 2402 (class 2604 OID 140144)
-- Name: idsitetypesol; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY correspondre_site_typesol ALTER COLUMN idsitetypesol SET DEFAULT nextval('correspondre_site_typesol_idsitetypesol_seq'::regclass);


--
-- TOC entry 2405 (class 2604 OID 140145)
-- Name: idespece; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY espece ALTER COLUMN idespece SET DEFAULT nextval('espece_idespece_seq'::regclass);


--
-- TOC entry 2406 (class 2604 OID 140146)
-- Name: idoperateurprojet; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY executer_operateur_projet ALTER COLUMN idoperateurprojet SET DEFAULT nextval('executer_operateur_projet_idoperateurprojet_seq'::regclass);


--
-- TOC entry 2407 (class 2604 OID 140147)
-- Name: idprojetcommune; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY executer_projet_commune ALTER COLUMN idprojetcommune SET DEFAULT nextval('executer_projet_commune_idprojetcommune_seq'::regclass);


--
-- TOC entry 2408 (class 2604 OID 140148)
-- Name: idexploitation; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY exploitation ALTER COLUMN idexploitation SET DEFAULT nextval('exploitatio_idexploitation_seq'::regclass);


--
-- TOC entry 2409 (class 2604 OID 140149)
-- Name: idfacteurproduction; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY facteurproduction ALTER COLUMN idfacteurproduction SET DEFAULT nextval('facteurproduction_idfacteurproduction_seq'::regclass);


--
-- TOC entry 2411 (class 2604 OID 140150)
-- Name: idbailleuroperateur; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY financer_bailleur_operateur ALTER COLUMN idbailleuroperateur SET DEFAULT nextval('financer_bailleur_operateur_idbailleuroperateur_seq'::regclass);


--
-- TOC entry 2412 (class 2604 OID 140151)
-- Name: idbailleurprojet; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY financer_bailleur_projet ALTER COLUMN idbailleurprojet SET DEFAULT nextval('financer_bailleur_projet_idbailleurprojet_seq'::regclass);


--
-- TOC entry 2413 (class 2604 OID 140152)
-- Name: idtypegeomorphologie; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY geomorphologie ALTER COLUMN idtypegeomorphologie SET DEFAULT nextval('geomorphologie_idtypegeomorphologie_seq'::regclass);


--
-- TOC entry 2388 (class 2604 OID 140153)
-- Name: idgestionnaire; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY gestionnaire ALTER COLUMN idgestionnaire SET DEFAULT nextval('gestionnaire_idgestionnaire_seq'::regclass);


--
-- TOC entry 2377 (class 2604 OID 140154)
-- Name: idlocalite; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY localite ALTER COLUMN idlocalite SET DEFAULT nextval('localite_idlocalite_seq'::regclass);


--
-- TOC entry 2415 (class 2604 OID 140155)
-- Name: idcollecteursite; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY observer_collecteur_site ALTER COLUMN idcollecteursite SET DEFAULT nextval('observer_collecteur_site_idcollecteursite_seq'::regclass);


--
-- TOC entry 2380 (class 2604 OID 140156)
-- Name: idoperateur; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY operateur ALTER COLUMN idoperateur SET DEFAULT nextval('operateur_idoperateur_seq'::regclass);


--
-- TOC entry 2410 (class 2604 OID 140157)
-- Name: idgestionnairefacteurproduction; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY posseder_gestionnaire_facteurproduction ALTER COLUMN idgestionnairefacteurproduction SET DEFAULT nextval('posseder_gestionnaire_facteur_idgestionnairefacteurproducti_seq'::regclass);


--
-- TOC entry 2384 (class 2604 OID 140158)
-- Name: idprojet; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY projet ALTER COLUMN idprojet SET DEFAULT nextval('projet_idprojet_seq'::regclass);


--
-- TOC entry 2403 (class 2604 OID 140159)
-- Name: idprovince; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY province ALTER COLUMN idprovince SET DEFAULT nextval('province_idprovince_seq'::regclass);


--
-- TOC entry 2391 (class 2604 OID 140160)
-- Name: idappuigestop; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY recevoir_appui_gest_op ALTER COLUMN idappuigestop SET DEFAULT nextval('recevoir_appui_gest_op_idappuigestop_seq'::regclass);


--
-- TOC entry 2416 (class 2604 OID 140161)
-- Name: idreconnaissance; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY reconnaissance ALTER COLUMN idreconnaissance SET DEFAULT nextval('reconnaissance_idreconnaissance_seq'::regclass);


--
-- TOC entry 2404 (class 2604 OID 140162)
-- Name: idregion; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY region ALTER COLUMN idregion SET DEFAULT nextval('region_idregion_seq'::regclass);


--
-- TOC entry 2417 (class 2604 OID 140163)
-- Name: idrevenuannuel; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY revenuannuel ALTER COLUMN idrevenuannuel SET DEFAULT nextval('revenuannuel_idrevenuannuel_seq'::regclass);


--
-- TOC entry 2386 (class 2604 OID 140164)
-- Name: idsite; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY site ALTER COLUMN idsite SET DEFAULT nextval('site_idsite_seq'::regclass);


--
-- TOC entry 2420 (class 2604 OID 140165)
-- Name: idsouscategorie; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY souscategorie ALTER COLUMN idsouscategorie SET DEFAULT nextval('souscategorie_idsouscategorie_seq'::regclass);


--
-- TOC entry 2421 (class 2604 OID 140166)
-- Name: idstatutfoncier; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY statutfoncier ALTER COLUMN idstatutfoncier SET DEFAULT nextval('statutfoncier_idstatutfoncier_seq'::regclass);


--
-- TOC entry 2422 (class 2604 OID 140167)
-- Name: idtype; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY typecollectif ALTER COLUMN idtype SET DEFAULT nextval('typecollectif_idtype_seq'::regclass);


--
-- TOC entry 2423 (class 2604 OID 140168)
-- Name: idtypesol; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY typesol ALTER COLUMN idtypesol SET DEFAULT nextval('typesol_idtypesol_seq'::regclass);


--
-- TOC entry 2424 (class 2604 OID 140169)
-- Name: iduser; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY users ALTER COLUMN iduser SET DEFAULT nextval('user_iduser_seq'::regclass);


--
-- TOC entry 2419 (class 2604 OID 140170)
-- Name: idvegetalisation; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY vegetalisation ALTER COLUMN idvegetalisation SET DEFAULT nextval('vegetalisation_idvegetalisation_seq'::regclass);


--
-- TOC entry 2418 (class 2604 OID 140171)
-- Name: idvocation; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY vocation ALTER COLUMN idvocation SET DEFAULT nextval('vocation_idvocation_seq'::regclass);


--
-- TOC entry 2495 (class 2606 OID 140173)
-- Name: exploitatio_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY exploitation
    ADD CONSTRAINT exploitatio_pkey PRIMARY KEY (idexploitation);


--
-- TOC entry 2427 (class 2606 OID 140175)
-- Name: pk_amenagement; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY amenagement
    ADD CONSTRAINT pk_amenagement PRIMARY KEY (idamenagement);


--
-- TOC entry 2430 (class 2606 OID 140177)
-- Name: pk_amenager; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY amenager
    ADD CONSTRAINT pk_amenager PRIMARY KEY (idamenager);


--
-- TOC entry 2433 (class 2606 OID 140179)
-- Name: pk_amenager_espece; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY amenager_espece
    ADD CONSTRAINT pk_amenager_espece PRIMARY KEY (idamenagerespece);


--
-- TOC entry 2436 (class 2606 OID 140181)
-- Name: pk_amenager_vegetalisation; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY amenager_vegetalisation
    ADD CONSTRAINT pk_amenager_vegetalisation PRIMARY KEY (idamenagervegetalisation);


--
-- TOC entry 2451 (class 2606 OID 140183)
-- Name: pk_appui; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY appui
    ADD CONSTRAINT pk_appui PRIMARY KEY (idappui);


--
-- TOC entry 2460 (class 2606 OID 140185)
-- Name: pk_bailleur; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY bailleur
    ADD CONSTRAINT pk_bailleur PRIMARY KEY (idbailleur);


--
-- TOC entry 2463 (class 2606 OID 140187)
-- Name: pk_categorieamenagement; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY categorieamenagement
    ADD CONSTRAINT pk_categorieamenagement PRIMARY KEY (idcategorieamenagement);


--
-- TOC entry 2466 (class 2606 OID 140189)
-- Name: pk_categorievocation; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY categorievocation
    ADD CONSTRAINT pk_categorievocation PRIMARY KEY (idcategorievocation);


--
-- TOC entry 2469 (class 2606 OID 140191)
-- Name: pk_collecteur; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY collecteur
    ADD CONSTRAINT pk_collecteur PRIMARY KEY (idcollecteur);


--
-- TOC entry 2472 (class 2606 OID 140193)
-- Name: pk_commune; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY commune
    ADD CONSTRAINT pk_commune PRIMARY KEY (idcommune);


--
-- TOC entry 2475 (class 2606 OID 140195)
-- Name: pk_correspondre_site_geomorphologie; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY correspondre_site_geomorphologie
    ADD CONSTRAINT pk_correspondre_site_geomorphologie PRIMARY KEY (idsitegeomorphologie);


--
-- TOC entry 2478 (class 2606 OID 140197)
-- Name: pk_correspondre_site_typesol; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY correspondre_site_typesol
    ADD CONSTRAINT pk_correspondre_site_typesol PRIMARY KEY (idsitetypesol);


--
-- TOC entry 2487 (class 2606 OID 140199)
-- Name: pk_espece; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY espece
    ADD CONSTRAINT pk_espece PRIMARY KEY (idespece);


--
-- TOC entry 2490 (class 2606 OID 140201)
-- Name: pk_executer_operateur_projet; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY executer_operateur_projet
    ADD CONSTRAINT pk_executer_operateur_projet PRIMARY KEY (idoperateurprojet);


--
-- TOC entry 2493 (class 2606 OID 140203)
-- Name: pk_executer_projet_commune; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY executer_projet_commune
    ADD CONSTRAINT pk_executer_projet_commune PRIMARY KEY (idprojetcommune);


--
-- TOC entry 2498 (class 2606 OID 140205)
-- Name: pk_facteurproduction; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY facteurproduction
    ADD CONSTRAINT pk_facteurproduction PRIMARY KEY (idfacteurproduction);


--
-- TOC entry 2504 (class 2606 OID 140207)
-- Name: pk_financer_bailleur_operateur; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY financer_bailleur_operateur
    ADD CONSTRAINT pk_financer_bailleur_operateur PRIMARY KEY (idbailleuroperateur);


--
-- TOC entry 2507 (class 2606 OID 140209)
-- Name: pk_financer_bailleur_projet; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY financer_bailleur_projet
    ADD CONSTRAINT pk_financer_bailleur_projet PRIMARY KEY (idbailleurprojet);


--
-- TOC entry 2510 (class 2606 OID 140211)
-- Name: pk_geomorphologie; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY geomorphologie
    ADD CONSTRAINT pk_geomorphologie PRIMARY KEY (idtypegeomorphologie);


--
-- TOC entry 2454 (class 2606 OID 140213)
-- Name: pk_gestionnaire; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY gestionnaire
    ADD CONSTRAINT pk_gestionnaire PRIMARY KEY (idgestionnaire);


--
-- TOC entry 2439 (class 2606 OID 140215)
-- Name: pk_localite; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY localite
    ADD CONSTRAINT pk_localite PRIMARY KEY (idlocalite);


--
-- TOC entry 2513 (class 2606 OID 140217)
-- Name: pk_observer_collecteur_site; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY observer_collecteur_site
    ADD CONSTRAINT pk_observer_collecteur_site PRIMARY KEY (idcollecteursite);


--
-- TOC entry 2442 (class 2606 OID 140219)
-- Name: pk_operateur; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY operateur
    ADD CONSTRAINT pk_operateur PRIMARY KEY (idoperateur);


--
-- TOC entry 2500 (class 2606 OID 140221)
-- Name: pk_posseder_gestionnaire_facteurproduction; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY posseder_gestionnaire_facteurproduction
    ADD CONSTRAINT pk_posseder_gestionnaire_facteurproduction PRIMARY KEY (idgestionnaire, idfacteurproduction);


--
-- TOC entry 2444 (class 2606 OID 140223)
-- Name: pk_projet; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY projet
    ADD CONSTRAINT pk_projet PRIMARY KEY (idprojet);


--
-- TOC entry 2480 (class 2606 OID 140225)
-- Name: pk_province; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY province
    ADD CONSTRAINT pk_province PRIMARY KEY (idprovince);


--
-- TOC entry 2456 (class 2606 OID 140227)
-- Name: pk_recevoir_appui_gest_op; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY recevoir_appui_gest_op
    ADD CONSTRAINT pk_recevoir_appui_gest_op PRIMARY KEY (idappuigestop);


--
-- TOC entry 2483 (class 2606 OID 140229)
-- Name: pk_region; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY region
    ADD CONSTRAINT pk_region PRIMARY KEY (idregion);


--
-- TOC entry 2517 (class 2606 OID 140231)
-- Name: pk_revenuannuel; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY revenuannuel
    ADD CONSTRAINT pk_revenuannuel PRIMARY KEY (idrevenuannuel);


--
-- TOC entry 2447 (class 2606 OID 140233)
-- Name: pk_site; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY site
    ADD CONSTRAINT pk_site PRIMARY KEY (idsite);


--
-- TOC entry 2528 (class 2606 OID 140235)
-- Name: pk_statutfoncier; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY statutfoncier
    ADD CONSTRAINT pk_statutfoncier PRIMARY KEY (idstatutfoncier);


--
-- TOC entry 2533 (class 2606 OID 140237)
-- Name: pk_typesol; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY typesol
    ADD CONSTRAINT pk_typesol PRIMARY KEY (idtypesol);


--
-- TOC entry 2523 (class 2606 OID 140239)
-- Name: pk_vegetalisation; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY vegetalisation
    ADD CONSTRAINT pk_vegetalisation PRIMARY KEY (idvegetalisation);


--
-- TOC entry 2520 (class 2606 OID 140241)
-- Name: pk_vocation; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY vocation
    ADD CONSTRAINT pk_vocation PRIMARY KEY (idvocation);


--
-- TOC entry 2515 (class 2606 OID 140243)
-- Name: reconnaissance_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY reconnaissance
    ADD CONSTRAINT reconnaissance_pkey PRIMARY KEY (idreconnaissance);


--
-- TOC entry 2526 (class 2606 OID 140245)
-- Name: souscategorie_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY souscategorie
    ADD CONSTRAINT souscategorie_pkey PRIMARY KEY (idsouscategorie);


--
-- TOC entry 2531 (class 2606 OID 140247)
-- Name: typecollectif_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY typecollectif
    ADD CONSTRAINT typecollectif_pkey PRIMARY KEY (idtype);


--
-- TOC entry 2536 (class 2606 OID 140249)
-- Name: user_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY users
    ADD CONSTRAINT user_pkey PRIMARY KEY (iduser);


--
-- TOC entry 2425 (class 1259 OID 140250)
-- Name: amenagement_pk; Type: INDEX; Schema: public; Owner: postgres
--

CREATE UNIQUE INDEX amenagement_pk ON amenagement USING btree (idamenagement);


--
-- TOC entry 2431 (class 1259 OID 140251)
-- Name: amenager_espece_pk; Type: INDEX; Schema: public; Owner: postgres
--

CREATE UNIQUE INDEX amenager_espece_pk ON amenager_espece USING btree (idamenagerespece);


--
-- TOC entry 2428 (class 1259 OID 140252)
-- Name: amenager_pk; Type: INDEX; Schema: public; Owner: postgres
--

CREATE UNIQUE INDEX amenager_pk ON amenager USING btree (idamenager);


--
-- TOC entry 2434 (class 1259 OID 140253)
-- Name: amenager_vegetalisation_pk; Type: INDEX; Schema: public; Owner: postgres
--

CREATE UNIQUE INDEX amenager_vegetalisation_pk ON amenager_vegetalisation USING btree (idamenagervegetalisation);


--
-- TOC entry 2449 (class 1259 OID 140254)
-- Name: appui_pk; Type: INDEX; Schema: public; Owner: postgres
--

CREATE UNIQUE INDEX appui_pk ON appui USING btree (idappui);


--
-- TOC entry 2458 (class 1259 OID 140255)
-- Name: bailleur_pk; Type: INDEX; Schema: public; Owner: postgres
--

CREATE UNIQUE INDEX bailleur_pk ON bailleur USING btree (idbailleur);


--
-- TOC entry 2461 (class 1259 OID 140256)
-- Name: categorieamenagement_pk; Type: INDEX; Schema: public; Owner: postgres
--

CREATE UNIQUE INDEX categorieamenagement_pk ON categorieamenagement USING btree (idcategorieamenagement);


--
-- TOC entry 2464 (class 1259 OID 140257)
-- Name: categorievocation_pk; Type: INDEX; Schema: public; Owner: postgres
--

CREATE UNIQUE INDEX categorievocation_pk ON categorievocation USING btree (idcategorievocation);


--
-- TOC entry 2467 (class 1259 OID 140258)
-- Name: collecteur_pk; Type: INDEX; Schema: public; Owner: postgres
--

CREATE UNIQUE INDEX collecteur_pk ON collecteur USING btree (idcollecteur);


--
-- TOC entry 2470 (class 1259 OID 140259)
-- Name: commune_pk; Type: INDEX; Schema: public; Owner: postgres
--

CREATE UNIQUE INDEX commune_pk ON commune USING btree (idcommune);


--
-- TOC entry 2473 (class 1259 OID 140260)
-- Name: correspondre_site_geomorphologie_pk; Type: INDEX; Schema: public; Owner: postgres
--

CREATE UNIQUE INDEX correspondre_site_geomorphologie_pk ON correspondre_site_geomorphologie USING btree (idsitegeomorphologie);


--
-- TOC entry 2476 (class 1259 OID 140261)
-- Name: correspondre_site_typesol_pk; Type: INDEX; Schema: public; Owner: postgres
--

CREATE UNIQUE INDEX correspondre_site_typesol_pk ON correspondre_site_typesol USING btree (idsitetypesol);


--
-- TOC entry 2485 (class 1259 OID 140262)
-- Name: espece_pk; Type: INDEX; Schema: public; Owner: postgres
--

CREATE UNIQUE INDEX espece_pk ON espece USING btree (idespece);


--
-- TOC entry 2488 (class 1259 OID 140263)
-- Name: executer_operateur_projet_pk; Type: INDEX; Schema: public; Owner: postgres
--

CREATE UNIQUE INDEX executer_operateur_projet_pk ON executer_operateur_projet USING btree (idoperateurprojet);


--
-- TOC entry 2491 (class 1259 OID 140264)
-- Name: executer_projet_commune_pk; Type: INDEX; Schema: public; Owner: postgres
--

CREATE UNIQUE INDEX executer_projet_commune_pk ON executer_projet_commune USING btree (idprojetcommune);


--
-- TOC entry 2496 (class 1259 OID 140265)
-- Name: facteurproduction_pk; Type: INDEX; Schema: public; Owner: postgres
--

CREATE UNIQUE INDEX facteurproduction_pk ON facteurproduction USING btree (idfacteurproduction);


--
-- TOC entry 2502 (class 1259 OID 140266)
-- Name: financer_bailleur_operateur_pk; Type: INDEX; Schema: public; Owner: postgres
--

CREATE UNIQUE INDEX financer_bailleur_operateur_pk ON financer_bailleur_operateur USING btree (idbailleuroperateur);


--
-- TOC entry 2505 (class 1259 OID 140267)
-- Name: financer_bailleur_projet_pk; Type: INDEX; Schema: public; Owner: postgres
--

CREATE UNIQUE INDEX financer_bailleur_projet_pk ON financer_bailleur_projet USING btree (idbailleurprojet);


--
-- TOC entry 2508 (class 1259 OID 140268)
-- Name: geomorphologie_pk; Type: INDEX; Schema: public; Owner: postgres
--

CREATE UNIQUE INDEX geomorphologie_pk ON geomorphologie USING btree (idtypegeomorphologie);


--
-- TOC entry 2452 (class 1259 OID 140269)
-- Name: gestionnaire_pk; Type: INDEX; Schema: public; Owner: postgres
--

CREATE UNIQUE INDEX gestionnaire_pk ON gestionnaire USING btree (idgestionnaire);


--
-- TOC entry 2437 (class 1259 OID 140270)
-- Name: localite_pk; Type: INDEX; Schema: public; Owner: postgres
--

CREATE UNIQUE INDEX localite_pk ON localite USING btree (idlocalite);


--
-- TOC entry 2511 (class 1259 OID 140271)
-- Name: observer_collecteur_site_pk; Type: INDEX; Schema: public; Owner: postgres
--

CREATE UNIQUE INDEX observer_collecteur_site_pk ON observer_collecteur_site USING btree (idcollecteursite);


--
-- TOC entry 2440 (class 1259 OID 140272)
-- Name: operateur_pk; Type: INDEX; Schema: public; Owner: postgres
--

CREATE UNIQUE INDEX operateur_pk ON operateur USING btree (idoperateur);


--
-- TOC entry 2501 (class 1259 OID 140273)
-- Name: posseder_gestionnaire_facteurproduction_pk; Type: INDEX; Schema: public; Owner: postgres
--

CREATE UNIQUE INDEX posseder_gestionnaire_facteurproduction_pk ON posseder_gestionnaire_facteurproduction USING btree (idgestionnairefacteurproduction);


--
-- TOC entry 2445 (class 1259 OID 140274)
-- Name: projet_pk; Type: INDEX; Schema: public; Owner: postgres
--

CREATE UNIQUE INDEX projet_pk ON projet USING btree (idprojet);


--
-- TOC entry 2481 (class 1259 OID 140275)
-- Name: province_pk; Type: INDEX; Schema: public; Owner: postgres
--

CREATE UNIQUE INDEX province_pk ON province USING btree (idprovince);


--
-- TOC entry 2457 (class 1259 OID 140276)
-- Name: recevoir_appui_gest_op_pk; Type: INDEX; Schema: public; Owner: postgres
--

CREATE UNIQUE INDEX recevoir_appui_gest_op_pk ON recevoir_appui_gest_op USING btree (idappuigestop);


--
-- TOC entry 2484 (class 1259 OID 140277)
-- Name: region_pk; Type: INDEX; Schema: public; Owner: postgres
--

CREATE UNIQUE INDEX region_pk ON region USING btree (idregion);


--
-- TOC entry 2518 (class 1259 OID 140278)
-- Name: revenuannuel_pk; Type: INDEX; Schema: public; Owner: postgres
--

CREATE UNIQUE INDEX revenuannuel_pk ON revenuannuel USING btree (idrevenuannuel);


--
-- TOC entry 2448 (class 1259 OID 140279)
-- Name: site_pk; Type: INDEX; Schema: public; Owner: postgres
--

CREATE UNIQUE INDEX site_pk ON site USING btree (idsite);


--
-- TOC entry 2529 (class 1259 OID 140280)
-- Name: statutfoncier_pk; Type: INDEX; Schema: public; Owner: postgres
--

CREATE UNIQUE INDEX statutfoncier_pk ON statutfoncier USING btree (idstatutfoncier);


--
-- TOC entry 2534 (class 1259 OID 140281)
-- Name: typesol_pk; Type: INDEX; Schema: public; Owner: postgres
--

CREATE UNIQUE INDEX typesol_pk ON typesol USING btree (idtypesol);


--
-- TOC entry 2524 (class 1259 OID 140282)
-- Name: vegetalisation_pk; Type: INDEX; Schema: public; Owner: postgres
--

CREATE UNIQUE INDEX vegetalisation_pk ON vegetalisation USING btree (idvegetalisation);


--
-- TOC entry 2521 (class 1259 OID 140283)
-- Name: vocation_pk; Type: INDEX; Schema: public; Owner: postgres
--

CREATE UNIQUE INDEX vocation_pk ON vocation USING btree (idvocation);


--
-- TOC entry 2547 (class 2606 OID 140284)
-- Name: fk_1_correspondre_site_geomorphologie; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY correspondre_site_geomorphologie
    ADD CONSTRAINT fk_1_correspondre_site_geomorphologie FOREIGN KEY (idtypegeomorphologie) REFERENCES geomorphologie(idtypegeomorphologie);


--
-- TOC entry 2549 (class 2606 OID 140289)
-- Name: fk_1_correspondre_site_typesol; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY correspondre_site_typesol
    ADD CONSTRAINT fk_1_correspondre_site_typesol FOREIGN KEY (idtypesol) REFERENCES typesol(idtypesol);


--
-- TOC entry 2552 (class 2606 OID 140294)
-- Name: fk_1_executer_operateur_projet; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY executer_operateur_projet
    ADD CONSTRAINT fk_1_executer_operateur_projet FOREIGN KEY (idoperateur) REFERENCES operateur(idoperateur);


--
-- TOC entry 2554 (class 2606 OID 140299)
-- Name: fk_1_executer_projet_commune; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY executer_projet_commune
    ADD CONSTRAINT fk_1_executer_projet_commune FOREIGN KEY (idcommune) REFERENCES commune(idcommune);


--
-- TOC entry 2558 (class 2606 OID 140304)
-- Name: fk_1_financer_bailleur_operateur; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY financer_bailleur_operateur
    ADD CONSTRAINT fk_1_financer_bailleur_operateur FOREIGN KEY (idoperateur) REFERENCES operateur(idoperateur);


--
-- TOC entry 2560 (class 2606 OID 140309)
-- Name: fk_1_financer_bailleur_projet; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY financer_bailleur_projet
    ADD CONSTRAINT fk_1_financer_bailleur_projet FOREIGN KEY (idbailleur) REFERENCES bailleur(idbailleur);


--
-- TOC entry 2562 (class 2606 OID 140314)
-- Name: fk_1_observer_collecteur_site; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY observer_collecteur_site
    ADD CONSTRAINT fk_1_observer_collecteur_site FOREIGN KEY (idcollecteur) REFERENCES collecteur(idcollecteur);


--
-- TOC entry 2556 (class 2606 OID 140319)
-- Name: fk_1_posseder_gestionnaire_facteurproduction; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY posseder_gestionnaire_facteurproduction
    ADD CONSTRAINT fk_1_posseder_gestionnaire_facteurproduction FOREIGN KEY (idgestionnaire) REFERENCES gestionnaire(idgestionnaire);


--
-- TOC entry 2543 (class 2606 OID 140324)
-- Name: fk_1_recevoir_appui_gest_op; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY recevoir_appui_gest_op
    ADD CONSTRAINT fk_1_recevoir_appui_gest_op FOREIGN KEY (idoperateur) REFERENCES operateur(idoperateur);


--
-- TOC entry 2539 (class 2606 OID 140329)
-- Name: fk_1_site_gestionnaire; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY site
    ADD CONSTRAINT fk_1_site_gestionnaire FOREIGN KEY (idgestionnaire) REFERENCES gestionnaire(idgestionnaire);


--
-- TOC entry 2548 (class 2606 OID 140334)
-- Name: fk_2_correspondre_site_geomorphologie; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY correspondre_site_geomorphologie
    ADD CONSTRAINT fk_2_correspondre_site_geomorphologie FOREIGN KEY (idsite) REFERENCES site(idsite);


--
-- TOC entry 2550 (class 2606 OID 140339)
-- Name: fk_2_correspondre_site_typesol; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY correspondre_site_typesol
    ADD CONSTRAINT fk_2_correspondre_site_typesol FOREIGN KEY (idsite) REFERENCES site(idsite);


--
-- TOC entry 2553 (class 2606 OID 140344)
-- Name: fk_2_executer_operateur_projet; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY executer_operateur_projet
    ADD CONSTRAINT fk_2_executer_operateur_projet FOREIGN KEY (idprojet) REFERENCES projet(idprojet);


--
-- TOC entry 2555 (class 2606 OID 140349)
-- Name: fk_2_executer_projet_commune; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY executer_projet_commune
    ADD CONSTRAINT fk_2_executer_projet_commune FOREIGN KEY (idprojet) REFERENCES projet(idprojet);


--
-- TOC entry 2559 (class 2606 OID 140354)
-- Name: fk_2_financer_bailleur_operateur; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY financer_bailleur_operateur
    ADD CONSTRAINT fk_2_financer_bailleur_operateur FOREIGN KEY (idbailleur) REFERENCES bailleur(idbailleur);


--
-- TOC entry 2561 (class 2606 OID 140359)
-- Name: fk_2_financer_bailleur_projet; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY financer_bailleur_projet
    ADD CONSTRAINT fk_2_financer_bailleur_projet FOREIGN KEY (idprojet) REFERENCES projet(idprojet);


--
-- TOC entry 2563 (class 2606 OID 140364)
-- Name: fk_2_observer_collecteur_site; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY observer_collecteur_site
    ADD CONSTRAINT fk_2_observer_collecteur_site FOREIGN KEY (idsite) REFERENCES site(idsite);


--
-- TOC entry 2557 (class 2606 OID 140369)
-- Name: fk_2_posseder_gestionnaire_facteurproduction; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY posseder_gestionnaire_facteurproduction
    ADD CONSTRAINT fk_2_posseder_gestionnaire_facteurproduction FOREIGN KEY (idfacteurproduction) REFERENCES facteurproduction(idfacteurproduction);


--
-- TOC entry 2544 (class 2606 OID 140374)
-- Name: fk_2_recevoir_appui_gest_op; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY recevoir_appui_gest_op
    ADD CONSTRAINT fk_2_recevoir_appui_gest_op FOREIGN KEY (idappui) REFERENCES appui(idappui);


--
-- TOC entry 2540 (class 2606 OID 140379)
-- Name: fk_2_site_statutfoncier; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY site
    ADD CONSTRAINT fk_2_site_statutfoncier FOREIGN KEY (idstatutfoncier) REFERENCES statutfoncier(idstatutfoncier);


--
-- TOC entry 2545 (class 2606 OID 140384)
-- Name: fk_3_recevoir_appui_gest_op; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY recevoir_appui_gest_op
    ADD CONSTRAINT fk_3_recevoir_appui_gest_op FOREIGN KEY (idgestionnaire) REFERENCES gestionnaire(idgestionnaire);


--
-- TOC entry 2541 (class 2606 OID 140389)
-- Name: fk_3_site_vocation; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY site
    ADD CONSTRAINT fk_3_site_vocation FOREIGN KEY (idvocation) REFERENCES vocation(idvocation);


--
-- TOC entry 2542 (class 2606 OID 140394)
-- Name: fk_4_site_localite; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY site
    ADD CONSTRAINT fk_4_site_localite FOREIGN KEY (idlocalite) REFERENCES localite(idlocalite);


--
-- TOC entry 2537 (class 2606 OID 140399)
-- Name: fk_amenagement_categorie; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY amenagement
    ADD CONSTRAINT fk_amenagement_categorie FOREIGN KEY (idcategorieamenagement) REFERENCES categorieamenagement(idcategorieamenagement);


--
-- TOC entry 2546 (class 2606 OID 140404)
-- Name: fk_commune_composer_province; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY commune
    ADD CONSTRAINT fk_commune_composer_province FOREIGN KEY (idprovince) REFERENCES province(idprovince);


--
-- TOC entry 2538 (class 2606 OID 140409)
-- Name: fk_localite_composer_commune; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY localite
    ADD CONSTRAINT fk_localite_composer_commune FOREIGN KEY (idcommune) REFERENCES commune(idcommune);


--
-- TOC entry 2551 (class 2606 OID 140414)
-- Name: fk_province_composer_region; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY province
    ADD CONSTRAINT fk_province_composer_region FOREIGN KEY (idregion) REFERENCES region(idregion);


--
-- TOC entry 2564 (class 2606 OID 140419)
-- Name: fk_revenuannuel_gestionnaire; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY revenuannuel
    ADD CONSTRAINT fk_revenuannuel_gestionnaire FOREIGN KEY (idgestionnaire) REFERENCES gestionnaire(idgestionnaire);


--
-- TOC entry 2565 (class 2606 OID 140424)
-- Name: fk_vocation_appartenir_categorie; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY vocation
    ADD CONSTRAINT fk_vocation_appartenir_categorie FOREIGN KEY (idcategorievocation) REFERENCES categorievocation(idcategorievocation);

INSERT INTO users (iduser, nom, prenom, fonction, service, telephone, email, identifiant, motdepasse, profil) VALUES (1, 'igmvss', 'igmvss', 'igmvss', 'igmvss', '56 67 67 67', 'igmvss@igmvss.net', 'igmvss', 'dccbe1ecfe489c0f991bc15b603e8d3f', 1);

--
-- TOC entry 2800 (class 0 OID 0)
-- Dependencies: 7
-- Name: public; Type: ACL; Schema: -; Owner: postgres
--

REVOKE ALL ON SCHEMA public FROM PUBLIC;
REVOKE ALL ON SCHEMA public FROM postgres;
GRANT ALL ON SCHEMA public TO postgres;
GRANT ALL ON SCHEMA public TO PUBLIC;


-- Completed on 2018-11-01 11:52:18

--
-- PostgreSQL database dump complete
--

