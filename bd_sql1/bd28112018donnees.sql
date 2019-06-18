--
-- PostgreSQL database dump
--

-- Dumped from database version 9.5.3
-- Dumped by pg_dump version 9.5.3

-- Started on 2018-11-28 11:33:48

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
-- TOC entry 2716 (class 0 OID 139707)
-- Dependencies: 181
-- Data for Name: amenagement; Type: TABLE DATA; Schema: public; Owner: postgres
--

INSERT INTO amenagement VALUES (1, 1, 'Haie vive défensive', NULL, 1);
INSERT INTO amenagement VALUES (2, 1, 'Production de semences forestières améliorées', NULL, 1);
INSERT INTO amenagement VALUES (3, 1, 'Routes boisées', NULL, 1);
INSERT INTO amenagement VALUES (4, 1, 'Etablissement de pépinière', NULL, 1);
INSERT INTO amenagement VALUES (5, 1, 'Haie vive antiérosive', NULL, 1);
INSERT INTO amenagement VALUES (6, 1, 'Tapis herbacé', NULL, 1);
INSERT INTO amenagement VALUES (7, 1, 'Plantation', NULL, 0);
INSERT INTO amenagement VALUES (8, 1, 'Bandes enherbées', NULL, 0);
INSERT INTO amenagement VALUES (9, 1, 'Autre', NULL, 0);
INSERT INTO amenagement VALUES (10, 1, 'Agroforesterie (AGF)', NULL, 0);
INSERT INTO amenagement VALUES (11, 1, 'Délimitation de terre de parcours', NULL, 0);
INSERT INTO amenagement VALUES (12, 1, 'Protection de forêt', NULL, 0);
INSERT INTO amenagement VALUES (13, 1, 'Jachère', NULL, 0);
INSERT INTO amenagement VALUES (14, 1, 'Régénération Naturelle Assistée (RNA)', NULL, 0);
INSERT INTO amenagement VALUES (15, 1, 'Mise en défens', NULL, 0);
INSERT INTO amenagement VALUES (16, 1, 'Feux précoces', NULL, 0);
INSERT INTO amenagement VALUES (17, 2, 'Diguettes en pierres alignées', 'Diguettes', 0);
INSERT INTO amenagement VALUES (18, 2, 'Sous-solage', 'Labour', 0);
INSERT INTO amenagement VALUES (19, 2, 'Labour cloisonné', 'Labour', 0);
INSERT INTO amenagement VALUES (20, 2, 'Tranchées de pare-feux', NULL, 0);
INSERT INTO amenagement VALUES (21, 2, 'Demi-lune', NULL, 0);
INSERT INTO amenagement VALUES (22, 2, 'Diguettes filtrantes ', 'Diguettes', 0);
INSERT INTO amenagement VALUES (23, 2, 'Diguettes en terre', 'Diguettes', 0);
INSERT INTO amenagement VALUES (24, 2, 'Zai forestier ', 'Zai', 0);
INSERT INTO amenagement VALUES (25, 2, 'Zai mécanisé', 'Zai', 0);
INSERT INTO amenagement VALUES (26, 2, 'Zai manuel', 'Zai', 0);
INSERT INTO amenagement VALUES (27, 2, 'Cordons pierreux végétalisés', 'Cordons pierreux', 0);
INSERT INTO amenagement VALUES (28, 2, 'Scarifiage du sol', 'Labour', 0);
INSERT INTO amenagement VALUES (29, 2, 'Cordons pierreux', 'Cordons pierreux', 0);
INSERT INTO amenagement VALUES (30, 2, 'Labour à plat', 'Labour', 0);
INSERT INTO amenagement VALUES (31, 2, 'Boulis pastoral/BCR', NULL, 0);
INSERT INTO amenagement VALUES (32, 2, 'Traitement des ravines', NULL, 0);
INSERT INTO amenagement VALUES (33, 2, 'Protection des berges', NULL, 0);
INSERT INTO amenagement VALUES (34, 2, 'Fixation des dunes', NULL, 0);
INSERT INTO amenagement VALUES (35, 2, 'Billonnage', NULL, 0);
INSERT INTO amenagement VALUES (36, 2, 'Autre', NULL, 0);
INSERT INTO amenagement VALUES (37, 3, 'Exploitation Produits Forestiers Non Ligneux', NULL, 0);
INSERT INTO amenagement VALUES (38, 3, 'Jardin Botanique', NULL, 0);
INSERT INTO amenagement VALUES (39, 3, 'Elaboration/mise en oeuvre de plan daménagement', NULL, 0);
INSERT INTO amenagement VALUES (40, 3, 'Etablissement de parcours pour bétail', NULL, 0);
INSERT INTO amenagement VALUES (41, 3, 'Gestion Durable des Fourêts', NULL, 0);
INSERT INTO amenagement VALUES (42, 3, 'Chantier dAménagement Forestier (CAF)', NULL, 0);
INSERT INTO amenagement VALUES (43, 3, 'Jardins nutritifs', NULL, 0);
INSERT INTO amenagement VALUES (44, 3, 'Ferme écologique', NULL, 0);
INSERT INTO amenagement VALUES (45, 3, 'Bocage', NULL, 0);
INSERT INTO amenagement VALUES (46, 3, 'Mise en place de ZOVIC', NULL, 0);
INSERT INTO amenagement VALUES (47, 3, 'Autre', NULL, 0);
INSERT INTO amenagement VALUES (48, 4, 'Réservoir d''eau', NULL, 0);
INSERT INTO amenagement VALUES (49, 4, 'Forage maraicher', NULL, 0);
INSERT INTO amenagement VALUES (50, 4, 'Micro irrigation goutte à goutte', NULL, 0);
INSERT INTO amenagement VALUES (51, 4, 'Micro irrigation à cuvette koglogo', NULL, 0);
INSERT INTO amenagement VALUES (52, 4, 'Bouli maraicher', NULL, 0);
INSERT INTO amenagement VALUES (53, 5, 'Combustibles issus de résidus végétaux', NULL, 0);
INSERT INTO amenagement VALUES (54, 5, 'Foyers améliorés', NULL, 0);
INSERT INTO amenagement VALUES (55, 6, 'Paillage/mulching', NULL, 0);
INSERT INTO amenagement VALUES (56, 6, 'Bonnes pratiques d''intrants chimiques', NULL, 0);
INSERT INTO amenagement VALUES (57, 6, 'Compost', NULL, 0);
INSERT INTO amenagement VALUES (58, 6, 'Biodigesteur', NULL, 0);
INSERT INTO amenagement VALUES (59, 6, 'Fosse fumière', NULL, 0);


--
-- TOC entry 2841 (class 0 OID 0)
-- Dependencies: 182
-- Name: amenagement_idamenagement_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('amenagement_idamenagement_seq', 1, false);


--
-- TOC entry 2718 (class 0 OID 139717)
-- Dependencies: 183
-- Data for Name: amenager; Type: TABLE DATA; Schema: public; Owner: postgres
--

INSERT INTO amenager VALUES (1, 49, 6, 15, 23, '2018-10-02', '2018-10-10', 4, 'longueur');
INSERT INTO amenager VALUES (2, 55, 10, 10, 26, '2009-05-11', '2009-07-11', 5, 'superficie');
INSERT INTO amenager VALUES (3, 54, 6, 13, 67, '2018-11-01', '2018-11-30', 5, 'longueur');


--
-- TOC entry 2719 (class 0 OID 139723)
-- Dependencies: 184
-- Data for Name: amenager_espece; Type: TABLE DATA; Schema: public; Owner: postgres
--



--
-- TOC entry 2842 (class 0 OID 0)
-- Dependencies: 185
-- Name: amenager_espece_idamenagerespece_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('amenager_espece_idamenagerespece_seq', 1, false);


--
-- TOC entry 2843 (class 0 OID 0)
-- Dependencies: 186
-- Name: amenager_idamenager_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('amenager_idamenager_seq', 3, true);


--
-- TOC entry 2722 (class 0 OID 139733)
-- Dependencies: 187
-- Data for Name: amenager_vegetalisation; Type: TABLE DATA; Schema: public; Owner: postgres
--



--
-- TOC entry 2844 (class 0 OID 0)
-- Dependencies: 188
-- Name: amenager_vegetalisation_idamenagervegetalisation_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('amenager_vegetalisation_idamenagervegetalisation_seq', 1, false);


--
-- TOC entry 2728 (class 0 OID 139784)
-- Dependencies: 197
-- Data for Name: appui; Type: TABLE DATA; Schema: public; Owner: postgres
--

INSERT INTO appui VALUES (1, 'Formation');
INSERT INTO appui VALUES (2, 'Voyage d''étude');
INSERT INTO appui VALUES (3, 'Financement');
INSERT INTO appui VALUES (4, 'Matériel');
INSERT INTO appui VALUES (5, 'Sensibilisation');
INSERT INTO appui VALUES (6, 'Appui organisationnel');
INSERT INTO appui VALUES (7, 'Micro-crédit');
INSERT INTO appui VALUES (8, 'Appui-conseil');


--
-- TOC entry 2845 (class 0 OID 0)
-- Dependencies: 198
-- Name: appui_idappui_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('appui_idappui_seq', 1, false);


--
-- TOC entry 2732 (class 0 OID 139808)
-- Dependencies: 202
-- Data for Name: bailleur; Type: TABLE DATA; Schema: public; Owner: postgres
--

INSERT INTO bailleur VALUES (1, 'FAO', 'DAMAS', 'PODA', '71 48 39 29', '', '');
INSERT INTO bailleur VALUES (2, 'UNION EUROPEENNE', 'PODA', 'Damas', '71 48 39 29', 'damas.poda@fao.org', 'Projet visant à promouvoir la Gestion Durable des Terres (GDT) et la Restauration des Terres Dégradées (RTD) afin de réduire la pauvreté, d''éliminer la faim, d''améliorer la résilience face aux effets des changements climatiques dans les zones arides et autres écosystèmes fragiles dans les pays ACP, au moyen de l''approche paysage.');
INSERT INTO bailleur VALUES (3, 'Fond International d''Aide de Developpement Agricole (FIDA)', 'Dumachel', 'Francois', '78894556', 'xxx', '');
INSERT INTO bailleur VALUES (4, 'FONDS FRANCAIS POUR L''ENVIRONNEMENT MONDIAL (FFEM)', 'PODA', 'Damas', '71 48 39 29', 'damas.poda@fao.org', 'Projet visant à mettre à l''échelle la Restauration des Forêts et des Paysages (RFP) et la Gestion Durable des Terres (RTD) en s''appuyant sur la décentralisation déjà en place au Burkina Faso et en  renforçant celle-ci; à travers le renforcement des capacités et les investissements mis à la disposition de trois communes burkinabé pour réaliser des activités de RFP et GDT sur leur territoire, et des Activités Génératrices de Revenu (AGR) contribuant à renforcer ces efforts de RFP et GDT.');
INSERT INTO bailleur VALUES (5, 'APEFE', 'DOULKOM', 'Adama', '25 41 90 82', 'doulkom.adama@yahoo.fr', 'Programme de Renforcement des capacités institutionnelles et organisationnelles des structures de coordination et de gestion de l''IGMVSS au Burkina Faso à travers le développement d''outils opérationnels et le renforcement des capacités');
INSERT INTO bailleur VALUES (6, 'Wallonnie Bruxelles International (WBI)', 'DOULKOM', 'Adama', '25 41 90 82', 'doulkom.adama@yahoo.fr', 'Programme de Renforcement des capacités institutionnelles des structures de coordination et de gestion de l''IGMVSS au Burkina Faso à travers le développement d''outils opérationnels et le renforcement des capacités ');
INSERT INTO bailleur VALUES (7, 'MECANISME MONDIAL', 'SOME/NIKIEMA', 'Estelle  Marie Raissa', '76 08 37 08', 'estell.nikiema@iucn.org', 'Projet visant à intégrer la Gestion Durable des Ressources Naturelles, des Terres et des risques écosystémiques dans les plans de développement au niveau local, et leur mise en œuvre à travers le montage de partenariats novateurs et multi acteurs incluant les secteurs publics et privés, dans le cadre d''une contribution à la mise en œuvre de l''IGMVSS.');
INSERT INTO bailleur VALUES (8, 'Etat burkinabe', 'DOULKOM', 'Adama', '25 41 90 82', 'doulkom.adama@yahoo.fr', 'Programme de Renforcement des capacités institutionnelles et organisationnelles des structures de coordination et de gestion de l''IGMVSS au Burkina Faso à travers le développement d''outils opérationnels et le renforcement des capacités');
INSERT INTO bailleur VALUES (9, 'Cooperation Belge au Developpement', 'Genin', 'Corentin', ' 003226540505', 'xxxxxxxxxxx', '');


--
-- TOC entry 2846 (class 0 OID 0)
-- Dependencies: 203
-- Name: bailleur_idbailleur_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('bailleur_idbailleur_seq', 1, false);


--
-- TOC entry 2734 (class 0 OID 139817)
-- Dependencies: 204
-- Data for Name: categorieamenagement; Type: TABLE DATA; Schema: public; Owner: postgres
--

INSERT INTO categorieamenagement VALUES (1, 'Amélioration du couvert végétal');
INSERT INTO categorieamenagement VALUES (2, 'Aménagement physique');
INSERT INTO categorieamenagement VALUES (3, 'Organisationnel');
INSERT INTO categorieamenagement VALUES (4, 'Irrigation');
INSERT INTO categorieamenagement VALUES (5, 'Energie');
INSERT INTO categorieamenagement VALUES (6, 'Fertilité');


--
-- TOC entry 2847 (class 0 OID 0)
-- Dependencies: 205
-- Name: categorieamenagement_idcategorieamenagement_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('categorieamenagement_idcategorieamenagement_seq', 1, false);


--
-- TOC entry 2736 (class 0 OID 139822)
-- Dependencies: 206
-- Data for Name: categorievocation; Type: TABLE DATA; Schema: public; Owner: postgres
--

INSERT INTO categorievocation VALUES (1, 'Zone de production');
INSERT INTO categorievocation VALUES (2, 'Zone de conservation');


--
-- TOC entry 2848 (class 0 OID 0)
-- Dependencies: 207
-- Name: categorievocation_idcategorievocation_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('categorievocation_idcategorievocation_seq', 1, false);


--
-- TOC entry 2738 (class 0 OID 139827)
-- Dependencies: 208
-- Data for Name: collecteur; Type: TABLE DATA; Schema: public; Owner: postgres
--

INSERT INTO collecteur VALUES (1, 'Talada', 'Judith', 'Chargé du suivi évaluation', '56874512', '');
INSERT INTO collecteur VALUES (2, 'George', 'Henri', 'Chargé du suivi évaluation', '65875489', '');
INSERT INTO collecteur VALUES (3, 'Simons', 'Julianne', 'Chargée de communication', '65875489', '');
INSERT INTO collecteur VALUES (4, 'Sawadogo', 'Julianne', 'Agent des forêts', '56894578', 'sawa.ju@yahoo.com');
INSERT INTO collecteur VALUES (5, 'Hitch', 'Jacques', 'Adjoint du DR', '45122356', 'hitch.j@gmail.com');


--
-- TOC entry 2849 (class 0 OID 0)
-- Dependencies: 209
-- Name: collecteur_idcollecteur_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('collecteur_idcollecteur_seq', 1, false);


--
-- TOC entry 2740 (class 0 OID 139838)
-- Dependencies: 210
-- Data for Name: commune; Type: TABLE DATA; Schema: public; Owner: postgres
--

INSERT INTO commune VALUES (1, 10, 'AMBSOUYA', NULL, NULL, NULL, NULL);
INSERT INTO commune VALUES (2, 15, 'ARBINDA', NULL, NULL, NULL, NULL);
INSERT INTO commune VALUES (3, 14, 'BANI', NULL, NULL, NULL, NULL);
INSERT INTO commune VALUES (10, 16, 'BOTOU', NULL, NULL, NULL, NULL);
INSERT INTO commune VALUES (11, 2, 'BOUDRI', NULL, NULL, NULL, NULL);
INSERT INTO commune VALUES (12, 9, 'BOULSA', NULL, NULL, NULL, NULL);
INSERT INTO commune VALUES (13, 17, 'BOUNDORE', NULL, NULL, NULL, NULL);
INSERT INTO commune VALUES (14, 7, 'BOUSSE', NULL, NULL, NULL, NULL);
INSERT INTO commune VALUES (15, 13, 'DABLO', NULL, NULL, NULL, NULL);
INSERT INTO commune VALUES (16, 10, 'DAPEOLGO', NULL, NULL, NULL, NULL);
INSERT INTO commune VALUES (17, 9, 'DARGO', NULL, NULL, NULL, NULL);
INSERT INTO commune VALUES (18, 11, 'DEOU', NULL, NULL, NULL, NULL);
INSERT INTO commune VALUES (19, 4, 'DIABO', NULL, NULL, NULL, NULL);
INSERT INTO commune VALUES (20, 16, 'DIAPAGA', NULL, NULL, NULL, NULL);
INSERT INTO commune VALUES (21, 4, 'DIAPANGOU', NULL, NULL, NULL, NULL);
INSERT INTO commune VALUES (22, 10, 'LOUMBILA', NULL, NULL, NULL, NULL);
INSERT INTO commune VALUES (23, 6, 'MADJOARI', NULL, NULL, NULL, NULL);
INSERT INTO commune VALUES (24, 13, 'MANE', NULL, NULL, NULL, NULL);
INSERT INTO commune VALUES (25, 3, 'MANI', NULL, NULL, NULL, NULL);
INSERT INTO commune VALUES (26, 17, 'MANSILA', NULL, NULL, NULL, NULL);
INSERT INTO commune VALUES (27, 11, 'MARKOYE', NULL, NULL, NULL, NULL);
INSERT INTO commune VALUES (28, 4, 'MATIAKOALI', NULL, NULL, NULL, NULL);
INSERT INTO commune VALUES (29, 2, 'MEGUE', NULL, NULL, NULL, NULL);
INSERT INTO commune VALUES (30, 2, 'MOGTEDO', NULL, NULL, NULL, NULL);
INSERT INTO commune VALUES (31, 15, 'DIGUEL', NULL, NULL, NULL, NULL);
INSERT INTO commune VALUES (32, 15, 'DJIBO', NULL, NULL, NULL, NULL);
INSERT INTO commune VALUES (33, 14, 'DORI', NULL, NULL, NULL, NULL);
INSERT INTO commune VALUES (34, 4, 'FADA-NGOURMA', NULL, NULL, NULL, NULL);
INSERT INTO commune VALUES (35, 14, 'FALAGOUNTOU', NULL, NULL, NULL, NULL);
INSERT INTO commune VALUES (36, 5, 'FOUTOURI', NULL, NULL, NULL, NULL);
INSERT INTO commune VALUES (37, 5, 'GAYERI', NULL, NULL, NULL, NULL);
INSERT INTO commune VALUES (38, 14, 'GORGADJI', NULL, NULL, NULL, NULL);
INSERT INTO commune VALUES (39, 11, 'GOROM-GOROM', NULL, NULL, NULL, NULL);
INSERT INTO commune VALUES (40, 1, 'GUIBARE', NULL, NULL, NULL, NULL);
INSERT INTO commune VALUES (41, 16, 'KANTCHARI', NULL, NULL, NULL, NULL);
INSERT INTO commune VALUES (42, 13, 'KAYA', NULL, NULL, NULL, NULL);
INSERT INTO commune VALUES (43, 8, 'SOLLE', NULL, NULL, NULL, NULL);
INSERT INTO commune VALUES (44, 18, 'TANGAYE', NULL, NULL, NULL, NULL);
INSERT INTO commune VALUES (45, 8, 'TITAO', NULL, NULL, NULL, NULL);
INSERT INTO commune VALUES (46, 19, 'TOUGO', NULL, NULL, NULL, NULL);
INSERT INTO commune VALUES (47, 12, 'YAKO', NULL, NULL, NULL, NULL);
INSERT INTO commune VALUES (48, 18, 'ZOGORE', NULL, NULL, NULL, NULL);
INSERT INTO commune VALUES (49, 18, 'NAMISSIGUIMA', NULL, NULL, NULL, NULL);
INSERT INTO commune VALUES (50, 18, 'THIOU', NULL, NULL, NULL, NULL);
INSERT INTO commune VALUES (51, 15, 'KELBO', NULL, NULL, NULL, NULL);
INSERT INTO commune VALUES (52, 3, 'KOALA', NULL, NULL, NULL, NULL);
INSERT INTO commune VALUES (53, 2, 'KOGHO', NULL, NULL, NULL, NULL);
INSERT INTO commune VALUES (54, 6, 'KOMPIENGA', NULL, NULL, NULL, NULL);
INSERT INTO commune VALUES (55, 1, 'KONGOUSSI', NULL, NULL, NULL, NULL);
INSERT INTO commune VALUES (56, 13, 'KORSIMORO', NULL, NULL, NULL, NULL);
INSERT INTO commune VALUES (57, 15, 'KOUTOUGOU', NULL, NULL, NULL, NULL);
INSERT INTO commune VALUES (58, 7, 'LAYE', NULL, NULL, NULL, NULL);
INSERT INTO commune VALUES (59, 3, 'LIPTOUGOU', NULL, NULL, NULL, NULL);
INSERT INTO commune VALUES (60, 16, 'LOGBOU', NULL, NULL, NULL, NULL);
INSERT INTO commune VALUES (61, 1, 'BOURZANGA', 23556, 24979, 48535, 7085);
INSERT INTO commune VALUES (62, 9, 'NAGBINGOU', NULL, NULL, NULL, NULL);
INSERT INTO commune VALUES (63, 10, 'NAGREONGO', NULL, NULL, NULL, NULL);
INSERT INTO commune VALUES (64, 16, 'NAMOUNO', NULL, NULL, NULL, NULL);
INSERT INTO commune VALUES (65, 1, 'NASSERE', NULL, NULL, NULL, NULL);
INSERT INTO commune VALUES (66, 15, 'NASSOUMBOU', NULL, NULL, NULL, NULL);
INSERT INTO commune VALUES (67, 7, 'NIOU', NULL, NULL, NULL, NULL);
INSERT INTO commune VALUES (68, 10, 'OURGOU-MANEGA', NULL, NULL, NULL, NULL);
INSERT INTO commune VALUES (69, 11, 'OURSI', NULL, NULL, NULL, NULL);
INSERT INTO commune VALUES (70, 6, 'PAMA', NULL, NULL, NULL, NULL);
INSERT INTO commune VALUES (71, 16, 'PARTIAGA', NULL, NULL, NULL, NULL);
INSERT INTO commune VALUES (72, 13, 'PENSA', NULL, NULL, NULL, NULL);
INSERT INTO commune VALUES (73, 13, 'PIBAORE', NULL, NULL, NULL, NULL);
INSERT INTO commune VALUES (74, 3, 'PIELA', NULL, NULL, NULL, NULL);
INSERT INTO commune VALUES (75, 13, 'PISSILA', NULL, NULL, NULL, NULL);
INSERT INTO commune VALUES (76, 15, 'POBE-MENGAO', NULL, NULL, NULL, NULL);
INSERT INTO commune VALUES (77, 1, 'ROLLO', NULL, NULL, NULL, NULL);
INSERT INTO commune VALUES (78, 1, 'ROUKO', NULL, NULL, NULL, NULL);
INSERT INTO commune VALUES (79, 1, 'SABSE', NULL, NULL, NULL, NULL);
INSERT INTO commune VALUES (80, 14, 'SAMPELGA', NULL, NULL, NULL, NULL);
INSERT INTO commune VALUES (81, 2, 'SAOLGO', NULL, NULL, NULL, NULL);
INSERT INTO commune VALUES (82, 17, 'SEBBA', NULL, NULL, NULL, NULL);
INSERT INTO commune VALUES (83, 14, 'SEYTENGA', NULL, NULL, NULL, NULL);
INSERT INTO commune VALUES (84, 17, 'SOLHAN', NULL, NULL, NULL, NULL);
INSERT INTO commune VALUES (85, 7, 'SOURGOUBILA', NULL, NULL, NULL, NULL);
INSERT INTO commune VALUES (86, 16, 'TAMBAGA', NULL, NULL, NULL, NULL);
INSERT INTO commune VALUES (87, 17, 'TANKOUGOUNADIE', NULL, NULL, NULL, NULL);
INSERT INTO commune VALUES (88, 16, 'TANSARGA', NULL, NULL, NULL, NULL);
INSERT INTO commune VALUES (89, 3, 'THION', NULL, NULL, NULL, NULL);
INSERT INTO commune VALUES (90, 4, 'TIBGA', NULL, NULL, NULL, NULL);
INSERT INTO commune VALUES (91, 1, 'TIKARE', NULL, NULL, NULL, NULL);
INSERT INTO commune VALUES (92, 11, 'TIN-AKOFF', NULL, NULL, NULL, NULL);
INSERT INTO commune VALUES (93, 17, 'TITABE', NULL, NULL, NULL, NULL);
INSERT INTO commune VALUES (94, 7, 'TOEGUEN', NULL, NULL, NULL, NULL);
INSERT INTO commune VALUES (95, 15, 'TONGOMAYEL', NULL, NULL, NULL, NULL);
INSERT INTO commune VALUES (96, 9, 'TOUGOURI', NULL, NULL, NULL, NULL);
INSERT INTO commune VALUES (97, 9, 'YALGO', NULL, NULL, NULL, NULL);
INSERT INTO commune VALUES (98, 4, 'YAMBA', NULL, NULL, NULL, NULL);
INSERT INTO commune VALUES (99, 2, 'ZAM', NULL, NULL, NULL, NULL);
INSERT INTO commune VALUES (100, 9, 'ZEGUEDEGUEN', NULL, NULL, NULL, NULL);
INSERT INTO commune VALUES (101, 13, 'ZIGA', NULL, NULL, NULL, NULL);
INSERT INTO commune VALUES (102, 10, 'ZINIARE', NULL, NULL, NULL, NULL);
INSERT INTO commune VALUES (103, 10, 'ZITENGA', NULL, NULL, NULL, NULL);
INSERT INTO commune VALUES (104, 2, 'ZORGHO', NULL, NULL, NULL, NULL);
INSERT INTO commune VALUES (105, 2, 'ZOUNGOU', NULL, NULL, NULL, NULL);
INSERT INTO commune VALUES (106, 9, 'BOUROUM', NULL, NULL, NULL, NULL);
INSERT INTO commune VALUES (107, 13, 'BOUSSOUMA', NULL, NULL, NULL, NULL);
INSERT INTO commune VALUES (108, 1, 'ZIMTANGA', NULL, NULL, NULL, NULL);
INSERT INTO commune VALUES (109, 13, 'NAMISSIGUIMA', NULL, NULL, NULL, NULL);
INSERT INTO commune VALUES (110, 12, 'ARBOLLE', NULL, NULL, NULL, NULL);
INSERT INTO commune VALUES (111, 12, 'BAGARE', NULL, NULL, NULL, NULL);
INSERT INTO commune VALUES (112, 8, 'BAHN', NULL, NULL, NULL, NULL);
INSERT INTO commune VALUES (113, 18, 'BARGA', NULL, NULL, NULL, NULL);
INSERT INTO commune VALUES (114, 19, 'BASSI', NULL, NULL, NULL, NULL);
INSERT INTO commune VALUES (115, 12, 'BOKEN', NULL, NULL, NULL, NULL);
INSERT INTO commune VALUES (116, 19, 'BOUSSOU', NULL, NULL, NULL, NULL);
INSERT INTO commune VALUES (117, 12, 'GOMPONSOM', NULL, NULL, NULL, NULL);
INSERT INTO commune VALUES (118, 19, 'GOURSI', NULL, NULL, NULL, NULL);
INSERT INTO commune VALUES (119, 18, 'KAIN', NULL, NULL, NULL, NULL);
INSERT INTO commune VALUES (120, 18, 'KALSAKA', NULL, NULL, NULL, NULL);
INSERT INTO commune VALUES (121, 12, 'KIRSI', NULL, NULL, NULL, NULL);
INSERT INTO commune VALUES (122, 18, 'KOSSOUKA', NULL, NULL, NULL, NULL);
INSERT INTO commune VALUES (123, 18, 'KOUMBRI', NULL, NULL, NULL, NULL);
INSERT INTO commune VALUES (124, 12, 'LA-TODEN', NULL, NULL, NULL, NULL);
INSERT INTO commune VALUES (125, 19, 'LEBA', NULL, NULL, NULL, NULL);
INSERT INTO commune VALUES (126, 18, 'OUAHIGOUYA', NULL, NULL, NULL, NULL);
INSERT INTO commune VALUES (127, 8, 'OUINDIGUI', NULL, NULL, NULL, NULL);
INSERT INTO commune VALUES (128, 18, 'OULA', NULL, NULL, NULL, NULL);
INSERT INTO commune VALUES (129, 12, 'PILIMPIKOU', NULL, NULL, NULL, NULL);
INSERT INTO commune VALUES (130, 18, 'RAMBO', NULL, NULL, NULL, NULL);
INSERT INTO commune VALUES (131, 12, 'SAMBA', NULL, NULL, NULL, NULL);
INSERT INTO commune VALUES (132, 18, 'SENGUENEGA', NULL, NULL, NULL, NULL);


--
-- TOC entry 2850 (class 0 OID 0)
-- Dependencies: 211
-- Name: commune_idcommune_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('commune_idcommune_seq', 1, false);


--
-- TOC entry 2742 (class 0 OID 139843)
-- Dependencies: 212
-- Data for Name: correspondre_site_geomorphologie; Type: TABLE DATA; Schema: public; Owner: postgres
--



--
-- TOC entry 2851 (class 0 OID 0)
-- Dependencies: 213
-- Name: correspondre_site_geomorphologie_idsitegeomorphologie_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('correspondre_site_geomorphologie_idsitegeomorphologie_seq', 1, false);


--
-- TOC entry 2744 (class 0 OID 139848)
-- Dependencies: 214
-- Data for Name: correspondre_site_typesol; Type: TABLE DATA; Schema: public; Owner: postgres
--



--
-- TOC entry 2852 (class 0 OID 0)
-- Dependencies: 215
-- Name: correspondre_site_typesol_idsitetypesol_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('correspondre_site_typesol_idsitetypesol_seq', 1, false);


--
-- TOC entry 2748 (class 0 OID 139869)
-- Dependencies: 220
-- Data for Name: espece; Type: TABLE DATA; Schema: public; Owner: postgres
--

INSERT INTO espece VALUES (1, 'Karité', '');
INSERT INTO espece VALUES (2, 'Balanites', '');
INSERT INTO espece VALUES (3, 'Moringa', '');
INSERT INTO espece VALUES (4, 'Neem', '');
INSERT INTO espece VALUES (5, 'Kaicédra', '');
INSERT INTO espece VALUES (6, 'Palmier dattier', '');


--
-- TOC entry 2853 (class 0 OID 0)
-- Dependencies: 221
-- Name: espece_idespece_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('espece_idespece_seq', 1, false);


--
-- TOC entry 2750 (class 0 OID 139877)
-- Dependencies: 222
-- Data for Name: executer_operateur_projet; Type: TABLE DATA; Schema: public; Owner: postgres
--

INSERT INTO executer_operateur_projet VALUES (1, 13, 5, true, false, NULL);
INSERT INTO executer_operateur_projet VALUES (2, 12, 4, true, false, NULL);


--
-- TOC entry 2854 (class 0 OID 0)
-- Dependencies: 224
-- Name: executer_operateur_projet_idoperateurprojet_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('executer_operateur_projet_idoperateurprojet_seq', 2, true);


--
-- TOC entry 2752 (class 0 OID 139889)
-- Dependencies: 225
-- Data for Name: executer_projet_commune; Type: TABLE DATA; Schema: public; Owner: postgres
--

INSERT INTO executer_projet_commune VALUES (1, 57, 5);
INSERT INTO executer_projet_commune VALUES (2, 39, 5);
INSERT INTO executer_projet_commune VALUES (3, 52, 5);
INSERT INTO executer_projet_commune VALUES (4, 18, 5);
INSERT INTO executer_projet_commune VALUES (5, 18, 4);


--
-- TOC entry 2855 (class 0 OID 0)
-- Dependencies: 226
-- Name: executer_projet_commune_idprojetcommune_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('executer_projet_commune_idprojetcommune_seq', 5, true);


--
-- TOC entry 2856 (class 0 OID 0)
-- Dependencies: 229
-- Name: exploitatio_idexploitation_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('exploitatio_idexploitation_seq', 1, false);


--
-- TOC entry 2754 (class 0 OID 139898)
-- Dependencies: 228
-- Data for Name: exploitation; Type: TABLE DATA; Schema: public; Owner: postgres
--

INSERT INTO exploitation VALUES (1, 'Concession');
INSERT INTO exploitation VALUES (2, 'Personnelle');
INSERT INTO exploitation VALUES (3, 'Bail Emphytéotique');
INSERT INTO exploitation VALUES (4, 'Bail à ferme');
INSERT INTO exploitation VALUES (5, 'Prêt');
INSERT INTO exploitation VALUES (6, 'Location');
INSERT INTO exploitation VALUES (7, 'Contrat de location de l''Etat');


--
-- TOC entry 2756 (class 0 OID 139903)
-- Dependencies: 230
-- Data for Name: facteurproduction; Type: TABLE DATA; Schema: public; Owner: postgres
--

INSERT INTO facteurproduction VALUES (1, 'Charrette');
INSERT INTO facteurproduction VALUES (2, 'Charrue');
INSERT INTO facteurproduction VALUES (3, 'Brouette');
INSERT INTO facteurproduction VALUES (4, 'Tracteur ');
INSERT INTO facteurproduction VALUES (5, 'Faucille/Faux');
INSERT INTO facteurproduction VALUES (6, 'Tricycle');
INSERT INTO facteurproduction VALUES (7, 'Camion');
INSERT INTO facteurproduction VALUES (8, 'Animal de trait');
INSERT INTO facteurproduction VALUES (9, 'Barre à mine');
INSERT INTO facteurproduction VALUES (10, 'Pioche');
INSERT INTO facteurproduction VALUES (11, 'Pic');
INSERT INTO facteurproduction VALUES (12, 'Machette');
INSERT INTO facteurproduction VALUES (13, 'Arrosoir');
INSERT INTO facteurproduction VALUES (14, 'Barrique');
INSERT INTO facteurproduction VALUES (15, 'Râteau');
INSERT INTO facteurproduction VALUES (16, 'Daba');
INSERT INTO facteurproduction VALUES (17, 'Fourche');
INSERT INTO facteurproduction VALUES (18, 'Pelle');
INSERT INTO facteurproduction VALUES (19, 'Masse');
INSERT INTO facteurproduction VALUES (20, 'Pulvérisateur');
INSERT INTO facteurproduction VALUES (21, 'Triangle à pente/Grand A');
INSERT INTO facteurproduction VALUES (22, 'Rucher');
INSERT INTO facteurproduction VALUES (23, 'Autre');


--
-- TOC entry 2857 (class 0 OID 0)
-- Dependencies: 233
-- Name: facteurproduction_idfacteurproduction_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('facteurproduction_idfacteurproduction_seq', 1, false);


--
-- TOC entry 2759 (class 0 OID 139915)
-- Dependencies: 234
-- Data for Name: financer_bailleur_operateur; Type: TABLE DATA; Schema: public; Owner: postgres
--

INSERT INTO financer_bailleur_operateur VALUES (1, 12, 8, 678, 2018, -1);
INSERT INTO financer_bailleur_operateur VALUES (2, 13, 7, 78, 2018, 5);


--
-- TOC entry 2858 (class 0 OID 0)
-- Dependencies: 236
-- Name: financer_bailleur_operateur_idbailleuroperateur_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('financer_bailleur_operateur_idbailleuroperateur_seq', 2, true);


--
-- TOC entry 2761 (class 0 OID 139927)
-- Dependencies: 237
-- Data for Name: financer_bailleur_projet; Type: TABLE DATA; Schema: public; Owner: postgres
--

INSERT INTO financer_bailleur_projet VALUES (1, 9, 5, 16000, '2018');
INSERT INTO financer_bailleur_projet VALUES (2, 8, 4, 67, '2018');


--
-- TOC entry 2859 (class 0 OID 0)
-- Dependencies: 238
-- Name: financer_bailleur_projet_idbailleurprojet_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('financer_bailleur_projet_idbailleurprojet_seq', 2, true);


--
-- TOC entry 2763 (class 0 OID 139943)
-- Dependencies: 241
-- Data for Name: geomorphologie; Type: TABLE DATA; Schema: public; Owner: postgres
--



--
-- TOC entry 2860 (class 0 OID 0)
-- Dependencies: 242
-- Name: geomorphologie_idtypegeomorphologie_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('geomorphologie_idtypegeomorphologie_seq', 1, false);


--
-- TOC entry 2730 (class 0 OID 139789)
-- Dependencies: 199
-- Data for Name: gestionnaire; Type: TABLE DATA; Schema: public; Owner: postgres
--

INSERT INTO gestionnaire VALUES (1, 'individuel', 'Niala', 'Saydou', '54568987', 'ohfjksd', '1978-03-15', 'Masculin', 5, 3, NULL, NULL, NULL, NULL);
INSERT INTO gestionnaire VALUES (2, 'individuel', 'Dupont', 'Micheline', '895654', 'ofidhjshf', '1968-09-13', 'Féminin', 4, 2, NULL, NULL, NULL, NULL);
INSERT INTO gestionnaire VALUES (3, 'individuel', 'Dada', 'Frances', '985623', 'd.frances@yahoo.fr', '1990-12-14', 'Féminin', 2, 0, NULL, NULL, NULL, NULL);
INSERT INTO gestionnaire VALUES (4, 'individuel', 'Yaméogo', 'Didier', '895423', 'didi.yam@hotmail.com', '1980-02-22', 'Masculin', 6, 4, NULL, NULL, NULL, NULL);
INSERT INTO gestionnaire VALUES (5, 'collectif', 'aa', 'bb', '11111111', '', NULL, NULL, NULL, NULL, 'palga', 'Féminin', 'Association', 10);
INSERT INTO gestionnaire VALUES (6, 'collectif', 'Youkri', 'Joachim', '78894556', 'y.jojo@gmail.com', NULL, NULL, NULL, NULL, 'Association pr une afrique forte', 'Mixte', 'Association', 455500);
INSERT INTO gestionnaire VALUES (7, 'collectif', 'Tiry', 'Henri', '56451223', 'tiry.h@yahoo.fr', NULL, NULL, NULL, NULL, 'Union fédéral des fermiers', 'Masculin', 'Union', 458);
INSERT INTO gestionnaire VALUES (8, 'individuel', 'Durien', 'Jules', '56457889', '', '1968-10-13', 'Masculin', 5, 2, NULL, NULL, NULL, NULL);
INSERT INTO gestionnaire VALUES (9, 'individuel', 'Baongo', 'France', '45561223', '', '1985-06-12', 'Féminin', 3, 0, NULL, NULL, NULL, NULL);
INSERT INTO gestionnaire VALUES (10, 'collectif', 'Tibaut', 'Sonia', '78894523', 't.sonia@yahoo.fr', NULL, NULL, NULL, NULL, 'Fédération fédérale', 'Féminin', 'Fédération', 4725);
INSERT INTO gestionnaire VALUES (11, 'collectif', 'Grisoux', 'Marcel', '12455689', 'marcel.g@yahoo.fr', NULL, NULL, NULL, NULL, 'FRATIF', 'Mixte', 'Coopérative', 45);
INSERT INTO gestionnaire VALUES (12, 'collectif', 'SANOU', 'Brice', '45123269', '', NULL, NULL, NULL, NULL, 'Songtaaba', 'Féminin', 'Groupement', 11);
INSERT INTO gestionnaire VALUES (13, 'individuel', 'Kafando', 'Michel', '54568987', '', '1978-03-15', 'Masculin', 5, 2, NULL, NULL, NULL, NULL);


--
-- TOC entry 2861 (class 0 OID 0)
-- Dependencies: 243
-- Name: gestionnaire_idgestionnaire_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('gestionnaire_idgestionnaire_seq', 1, false);


--
-- TOC entry 2724 (class 0 OID 139738)
-- Dependencies: 189
-- Data for Name: localite; Type: TABLE DATA; Schema: public; Owner: postgres
--

INSERT INTO localite VALUES (1, 27, 'Fadar-Fadar');
INSERT INTO localite VALUES (2, 11, 'Doui');


--
-- TOC entry 2862 (class 0 OID 0)
-- Dependencies: 244
-- Name: localite_idlocalite_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('localite_idlocalite_seq', 1, false);


--
-- TOC entry 2767 (class 0 OID 139952)
-- Dependencies: 245
-- Data for Name: observer_collecteur_site; Type: TABLE DATA; Schema: public; Owner: postgres
--

INSERT INTO observer_collecteur_site VALUES (1, 5, 9, '2018-10-19', '1455K');
INSERT INTO observer_collecteur_site VALUES (2, 4, 8, '2018-10-17', '78U');


--
-- TOC entry 2863 (class 0 OID 0)
-- Dependencies: 246
-- Name: observer_collecteur_site_idcollecteursite_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('observer_collecteur_site_idcollecteursite_seq', 1, false);


--
-- TOC entry 2725 (class 0 OID 139741)
-- Dependencies: 190
-- Data for Name: operateur; Type: TABLE DATA; Schema: public; Owner: postgres
--

INSERT INTO operateur VALUES (1, 'REACH ITALIA', 'YONLI', '...........', '...................@yahoo.fr', '60606060', 'Directeur Technique', '..............org');
INSERT INTO operateur VALUES (2, 'DREEVCC SAHEL', 'KABRE', 'Andèma', '..............@yahoo.fr', '60606060', 'Directeur Régional', '...........org');
INSERT INTO operateur VALUES (3, 'CENTRE NATIONAL DE SEMENCES FORESTIERES', '....................................', '.....................................', '...............@yahoo.fr', '60606060', 'Chef d''Antenne SAHEL', '...........org');
INSERT INTO operateur VALUES (4, 'INERA/Département Environnement et Forêts (Recherche)', 'HIEN', 'Dibloni', '..........@yahoo.fr', '60606060', 'Chef de département', '..............org');
INSERT INTO operateur VALUES (5, 'CRUS', '......................', '............................', '.....................@yahoo.fr', '60606060', '............................', '.........org');
INSERT INTO operateur VALUES (6, 'COMMUNE DE DORI', '.........................................', '......................................', '........................@yahoo.fr', '60606060', '.................................', '.............org');
INSERT INTO operateur VALUES (7, 'TIIPAALGA', 'TRAORE', 'Alain', '..............@yahoo.fr', '60606060', 'Chargé de programme Sahel', '..........org');
INSERT INTO operateur VALUES (8, 'Coordination Nationale de l''Initiative de la Grande Muraille Verte pour le Sahara et le Sahel', 'DOULKOM', 'Adama', 'doulkom.adama@yahoo.fr', '25 41 90 82', 'Coordonnateur National', '.....................');
INSERT INTO operateur VALUES (9, 'OSC (SPONG ET RESAD)', 'OUEDRAOGO ', 'Omer', '..................@yahoo.fr', '60606060', 'Sécretaire Exécutif', '...............................');
INSERT INTO operateur VALUES (10, 'SP_CNDD', 'TAGNABOU', 'D Lazare', 'dlazaretagnabou.@yahoo.fr', '70733560', 'Point Focal', '........................');
INSERT INTO operateur VALUES (11, 'COMMUNE DE BANI', '...........................', '..................................', '......................@yahoo.fr', '60606060', 'Maire ', '...........org');
INSERT INTO operateur VALUES (12, 'COMMUNE DE COALLA', '............................', '........................', '...........................@yahoo.fr', '60606060', 'Maire', '...........................');
INSERT INTO operateur VALUES (13, 'COMMUNE DE YAMBA', '.......................................', '........................................', '.......................@yahoo.fr', '60606060', 'Maire', '..............................');
INSERT INTO operateur VALUES (14, 'UNCDF/FENU (Fonds d''équipement des Nations Unies)', '..................................', '..............................', '...................@yahoo.fr', '60606060', '....................', '.....................................');
INSERT INTO operateur VALUES (15, 'FPDCT (Fonds Permanent pour le Développement des Collectivités Territoriales)', 'OUEDRAOGO', 'Issiaka', '.................@yahoo.fr', '60606060', 'Directeur Général', '...............................');


--
-- TOC entry 2864 (class 0 OID 0)
-- Dependencies: 249
-- Name: operateur_idoperateur_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('operateur_idoperateur_seq', 1, false);


--
-- TOC entry 2865 (class 0 OID 0)
-- Dependencies: 250
-- Name: posseder_gestionnaire_facteur_idgestionnairefacteurproducti_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('posseder_gestionnaire_facteur_idgestionnairefacteurproducti_seq', 1, false);


--
-- TOC entry 2757 (class 0 OID 139906)
-- Dependencies: 231
-- Data for Name: posseder_gestionnaire_facteurproduction; Type: TABLE DATA; Schema: public; Owner: postgres
--

INSERT INTO posseder_gestionnaire_facteurproduction VALUES (1, 12, 23);
INSERT INTO posseder_gestionnaire_facteurproduction VALUES (2, 12, 22);
INSERT INTO posseder_gestionnaire_facteurproduction VALUES (3, 12, 20);
INSERT INTO posseder_gestionnaire_facteurproduction VALUES (4, 12, 18);
INSERT INTO posseder_gestionnaire_facteurproduction VALUES (5, 13, 19);
INSERT INTO posseder_gestionnaire_facteurproduction VALUES (6, 13, 15);
INSERT INTO posseder_gestionnaire_facteurproduction VALUES (7, 13, 14);


--
-- TOC entry 2726 (class 0 OID 139749)
-- Dependencies: 191
-- Data for Name: projet; Type: TABLE DATA; Schema: public; Owner: postgres
--

INSERT INTO projet VALUES (1, 'Restauration des Forêts et des Paysages (RFP) et Gestion Durable des Terres (GDT)', 1800000, 579299, '2018-01-22', '2022-06-30', 'PODA', 'Damas', '71 48 39 29', '', '', 'Projet visant à contribuer au déploiement de la RFP/GDT de façon holistique, afin de fournir durablement de multiples biens et services, sociaux, économiques et environnementaux et atteindre l''objectif de neutralité en termes de dégradation des terres d''ici à 2030.');
INSERT INTO projet VALUES (2, 'Programme de Renforcement des Capacités de l''IGMVSS (Première Phase)', 765553646, 765553646, '2014-01-01', '2016-12-31', 'DOULKOM', 'Adama', '25 41 90 82', 'doulkom.adama@yahoo.fr', '', '');
INSERT INTO projet VALUES (3, 'Front Local Environnemental pour une Union Verte (FLEUVE)', 3531000, 800000, '2015-10-02', '2019-12-31', 'SOME/NIKIEMA', 'Estelle Marie Raissa', '76 08 37 08', 'estelle.nikiema@iucn.org', '', 'Projet intégrant la gestion durable des ressources naturelles, des terres et des risques écosystémiques dans les plans de développement au niveau local, et leur mise en œuvre à travers le montage de partenariats novateurs et multi acteurs incluant les secteurs publics et privés, dans le cadre d''une contribution à la mise en œuvre de l''IGMVSS.');
INSERT INTO projet VALUES (5, 'Projet song taaba', 20000000, 20000, '2016-08-06', '2018-08-05', 'Zoungrana', 'Fatao', '67676767', '', '', '');
INSERT INTO projet VALUES (4, 'Action Contre la Désertification (ACD)', 41000000, 1500000, '2014-07-28', '2019-02-27', 'PODA', 'Damas', '71 48 39 29', 'damas.poda@fao.org', '', 'Initiative visant à appuyer la mise en œuvre des plans d''action des pays membres de l''Initiative de la Grande Muraille Verte pour le Sahara et le Sahel à travers la promotion de la Gestion Durable des Terres (GDT) et la Restauration des Terres Dégradées (RTD) afin de réduire la pauvreté, d''éliminer la faim et améliorer la résilience face aux changements climatiques dans les zones arides et autres écosystèmes fragiles dans les pays ACP au moyen de l''approche paysage.');


--
-- TOC entry 2866 (class 0 OID 0)
-- Dependencies: 251
-- Name: projet_idprojet_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('projet_idprojet_seq', 1, false);


--
-- TOC entry 2746 (class 0 OID 139853)
-- Dependencies: 216
-- Data for Name: province; Type: TABLE DATA; Schema: public; Owner: postgres
--

INSERT INTO province VALUES (1, 1, 'BAM');
INSERT INTO province VALUES (2, 4, 'GANZOURGOU');
INSERT INTO province VALUES (3, 2, 'GNAGNA');
INSERT INTO province VALUES (4, 2, 'GOURMA');
INSERT INTO province VALUES (5, 2, 'KOMANDJARI');
INSERT INTO province VALUES (6, 2, 'KOMPIENGA');
INSERT INTO province VALUES (7, 4, 'KOURWEOGO');
INSERT INTO province VALUES (8, 3, 'LOROUM');
INSERT INTO province VALUES (9, 1, 'NAMENTENGA');
INSERT INTO province VALUES (10, 4, 'OUBRITENGA');
INSERT INTO province VALUES (11, 5, 'OUDALAN');
INSERT INTO province VALUES (12, 3, 'PASSORE');
INSERT INTO province VALUES (13, 1, 'SANMATENGA');
INSERT INTO province VALUES (14, 5, 'SENO');
INSERT INTO province VALUES (15, 5, 'SOUM');
INSERT INTO province VALUES (16, 2, 'TAPOA');
INSERT INTO province VALUES (17, 5, 'YAGHA');
INSERT INTO province VALUES (18, 3, 'YATENGA');
INSERT INTO province VALUES (19, 3, 'ZONDOMA');


--
-- TOC entry 2867 (class 0 OID 0)
-- Dependencies: 252
-- Name: province_idprovince_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('province_idprovince_seq', 1, false);


--
-- TOC entry 2731 (class 0 OID 139795)
-- Dependencies: 200
-- Data for Name: recevoir_appui_gest_op; Type: TABLE DATA; Schema: public; Owner: postgres
--

INSERT INTO recevoir_appui_gest_op VALUES (1, 14, 7, 6, '2015-09-15', '2016-09-04', 6, '', true, 3);
INSERT INTO recevoir_appui_gest_op VALUES (3, 10, 8, 1, '2017-09-15', '2018-09-14', 0, '', false, 5);
INSERT INTO recevoir_appui_gest_op VALUES (4, 11, 7, 6, '2016-09-10', '2018-09-14', 10, '', true, 5);
INSERT INTO recevoir_appui_gest_op VALUES (2, 14, 7, 1, '2018-10-02', '2018-10-20', 0, '', true, 4);
INSERT INTO recevoir_appui_gest_op VALUES (5, 12, 5, 4, '2018-10-02', '2018-10-18', 0, '', true, 4);


--
-- TOC entry 2868 (class 0 OID 0)
-- Dependencies: 253
-- Name: recevoir_appui_gest_op_idappuigestop_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('recevoir_appui_gest_op_idappuigestop_seq', 5, true);


--
-- TOC entry 2774 (class 0 OID 139977)
-- Dependencies: 254
-- Data for Name: reconnaissance; Type: TABLE DATA; Schema: public; Owner: postgres
--

INSERT INTO reconnaissance VALUES (1, 'Pas de reconnaissance');
INSERT INTO reconnaissance VALUES (2, 'APFR Individuelle');
INSERT INTO reconnaissance VALUES (3, 'APFR Collective');
INSERT INTO reconnaissance VALUES (4, 'Titres fonciers');
INSERT INTO reconnaissance VALUES (5, 'PV de cession/Mémorandum de cession');


--
-- TOC entry 2869 (class 0 OID 0)
-- Dependencies: 255
-- Name: reconnaissance_idreconnaissance_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('reconnaissance_idreconnaissance_seq', 1, false);


--
-- TOC entry 2747 (class 0 OID 139856)
-- Dependencies: 217
-- Data for Name: region; Type: TABLE DATA; Schema: public; Owner: postgres
--

INSERT INTO region VALUES (1, 'CENTRE-NORD');
INSERT INTO region VALUES (2, 'EST');
INSERT INTO region VALUES (3, 'NORD');
INSERT INTO region VALUES (4, 'PLATEAU-CENTRAL');
INSERT INTO region VALUES (5, 'SAHEL');


--
-- TOC entry 2870 (class 0 OID 0)
-- Dependencies: 256
-- Name: region_idregion_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('region_idregion_seq', 1, false);


--
-- TOC entry 2777 (class 0 OID 139989)
-- Dependencies: 258
-- Data for Name: revenuannuel; Type: TABLE DATA; Schema: public; Owner: postgres
--

INSERT INTO revenuannuel VALUES (1, 2, 54000, 2006);
INSERT INTO revenuannuel VALUES (2, 7, 569800, 2005);


--
-- TOC entry 2871 (class 0 OID 0)
-- Dependencies: 270
-- Name: revenuannuel_idrevenuannuel_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('revenuannuel_idrevenuannuel_seq', 1, false);


--
-- TOC entry 2727 (class 0 OID 139758)
-- Dependencies: 192
-- Data for Name: site; Type: TABLE DATA; Schema: public; Owner: postgres
--

INSERT INTO site VALUES (3, 1, 2, 1, 1, 'Site 1', NULL, 'Superficie', 'Polygone', '0106000020E6100000010000000103000000010000007A0000009193C8CB9CAA2841BB41A1CED5663941F2EDFF3F9AAA284183FDFFFFD1663941FCEDFFBFEDA828418EFDFFBF7F64394186EEFF1FB8992841ACFDFF7FA4543941D4EEFF3FD68D2841BEFDFF3FCF43394103EFFFDFA7872841D0FDFF7FB33C394109EFFFFFB1872841D0FDFFFF983B3941E5EEFFFF21882841CDFDFFFFA4373941E5EEFFFF4F882841CBFDFFFFE5353941CCEEFFFFB7882841CAFDFFFF4A333941A9EEFFFF69892841CDFDFFFF522F3941ABEEFFFF7D892841CDFDFFFF0D2E3941A1EEFFFF61892841C9FDFFFF3F2D3941A8EEFFFF03892841C8FDFFFF662C3941A6EEFFFFB7882841CDFDFFFF982B39419AEEFFFF91882841CEFDFFFF012B3941A5EEFFFF89882841CBFDFFFF8C2A39419CEEFFFFC9882841CDFDFFFF1129394192EEFFFFE5882841D0FDFFFFFC27394188EEFFFFBF882841CFFDFFFF0C27394184EEFFFF3B882841CCFDFFFFAC2539418BEEFFFFDD872841D3FDFFFF8424394188EEFFFF63872841D2FDFFFF9E2339418CEEFFFF22872841CCFDFF1F1823394197EEFFDFCF842841D4FDFFDFB21E3941E0EEFF5F087A2841EBFDFFBF5B0C3941F0EEFFDFE6782841EAFDFF3F620C3941AEF3FF7F1B17284185FEFF7F970E394153F4FFDF4B01284199FEFFBF1302394160F4FF1F49012841A3FEFF5F3F023941CCF4FFFF6FFF2741A4FEFFFF951F39419FF5FFFF19E92741B9FEFFFF951D3941DDF6FFFF1FC72741DDFEFFFF7129394168C40F7921482741E63F6A6CE71F394155FBFFFF0D08274176FFFFFF161B394157FBFFDF0B08274172FFFF1F171B39415EFBFF1F4D08274177FFFF1FE51B394151FBFFDFB808274177FFFFDF261C394152FBFFFFCB08274174FFFF7FEF1C39416AFBFF1F910A274170FFFF1F852F3941BEFBFF5FE3FA26417EFFFF9FD03D39419A533D28EBF1264121F20F1D444F39410AFCFFFF4FEF26417DFFFF1F5654394113FCFF5FD5ED264181FFFF3F5655394132FCFF9F3AE9264187FFFFBF7358394128FCFFDF19E9264187FFFFDF895839413BFCFFFFFDE4264189FFFFFFE85A394146FCFF3FD3E226418AFFFFBFC85C39414EFCFFFF03E226418CFFFFFF7B5D39415BFCFFFF29E0264186FFFFFF775F39415FFCFFFF3DDE264188FFFFFFBB60394177FCFFFFADDB26418EFFFFFFF461394176FCFF5FAED9264192FFFF5FF86239417EFCFFFFDFD826418BFFFFFF6063394186FCFFFF07D526418EFFFFFF976539419AFCFF7F70D1264191FFFF9F446839419DFCFF5F36CF264193FFFF7F35693941B4FCFFFFCFCB264193FFFFFFCF6A3941CFFCFF5F92C4264195FFFF1FB46D3941DCFCFF3FF4C1264197FFFF9F886F3941E2FCFFFF1DC026419BFFFFFFC6703941EEFCFFDF54BD264196FFFFBF15753941ECFCFFFFCFBB26419CFFFFFF91763941ECFCFF1F4CBC264196FFFFBF92763941812CE946D8C32641F9004E9E9D7639411A555A8490C72641B9FED8D19B7639415CBD040C10D02641A0A64A529E76394118AAB858FED626419BE7A55FAE763941088B130FE2DE264106E574B7AB763941966378D885E72641DB5D6EDBB4763941C6BE12595BEF264107E60E35B4763941A5A22E1229F72641CDB1B307CA763941AC050D33FAFE26410A7BEDFACD763941B982E2B690032741A8894360F976394178717DA90D1627414007B9FF13773941860F1AC26B1627419AAEF614147739411650F0A2421E274161C4EE231377394112D3AADF14262741C0A3A7861877394133630781E72D27412F76A06D16773941407CD321CB3527416E46B2A61E773941063A5327C43D27413001282923773941FCBB711896452741AF8A7FB12E7739417EF9CCA0224D274140F287F740773941325B1400275527414B1573C22C773941043C72CD035D2741855A855622773941EE88B7EF5A5E2741A0E503202C773941EE5EAB4DB1642741E8EC933A5A7739417B50409A726C2741D08F300959773941E618633743742741F2A3EBC056773941E83A9C4A277C27417E77FB0580773941AEC7F8841F842741C3BE71B87D773941CBFFEAE449872741F64B077A80773941DA34B639E8872741F742340D817739419E5EAA757F8C2741E6B7F9E9847739414A9540E924942741BA375EAE9D773941C4FCF09B839B274133B66D09A377394161220F348EA32741104FCE4BCE773941C3B592E105A527413443193CD6773941920ABDA716A52741DA91BA8DD677394133E3BC86CFA6274110DE24198E753941DF4BE85ED8A72741051E48E52E743941268180B299AA2741631FE858877039419694F5EC5BAD2741A91D86EADF6C39418400668D1DB027413E638C7B38693941B19BC670DFB22741989FEBF0906539415EA6AE5EA1B52741E416FF82E96139419824175963B827413146C1DC415E3941AFD313B824BB2741A369966E9A5A3941396DA7B1E3BD2741124FC016F6563941D9C410D0B3C527417CCA50B2FF563941545735C884CD274104E506590A573941B445B63416D22741406C84AF1057394163673F76E8D22741E557C2D011573941C6FA64967AD32741572C349112573941AB78084628D42741A7072D6F405739412D4D54B044D42741521BA6F147573941DEF6FFFFC3D72741CEFEFFFFDC543941E268C384334B28414C31993FA77639419C47F40F2A7028410CBF865186703941208B03391C722841159A3FA933703941FFE99B783C95284152E49A0F616A39419193C8CB9CAA2841BB41A1CED5663941');
INSERT INTO site VALUES (8, 2, 4, 1, 7, 'Site 6', NULL, 'Superficie', 'Polygone', '0106000020E6100000010000000103000000010000004E00000070F3FFFF7308284192FEFFFF43D538415AF3FFFFF30A284191FEFFFF01D538414CF3FFFFB90C284191FEFFFF1DD5384138F3FF5FF90D28418DFEFFDFD5D4384123F3FFFF1510284191FEFFFF58D4384108F3FFFFD911284186FEFFFF32D43841DAF2FFFFB116284187FEFFFF20D438414BF2FF5F5423284174FEFFBF4ED3384190F2FFFF4112284185FEFFFF1BB138414DF6FFFFA7B42741F8FEFFFF35B8384197F6FFFF1DA4274102FFFFFFA7A038412C89533A65702741223602126F9038413AF8FFFF8568274134FFFFFFF68D38419DF9FFFF713627415CFFFFFFFFA1384141AA5ADD2A32274172BA325FEAB03841E9F9FFFF2B3127415FFFFFFF62B4384197FAFFFF4B1827416AFFFFFFC2C9384169FAFFFF5520274169FFFF7F81CB384114FAFFFF013027415DFFFFFF02CD384188F9FFFF324727414CFFFFFF50C7384144F9FFFFD94F274143FFFFFF4AC038411EF9FFFF0B53274149FFFFFF87BC384122F9FFDFE253274143FFFF1F3AB93841E4F8FFFF275E274143FFFFFFEDBA384183F8FFFF306D274136FFFF7FFEBD38410CF8FFFFE77E274128FFFFFF16C23841EEF7FF1F2E82274120FFFF5F4EC2384191F7FFFF138F274119FFFFFFDCC3384180F7FFFF219127411AFFFFFFF8C3384174F7FFFFB393274117FFFFFF5FC4384161F7FFFF7595274111FFFFFFC7C438415EF7FF9F1F97274115FFFF5F5DC538414DF7FFFFE598274112FFFFFFFCC5384136F7FFFF519B274113FFFFFF01C6384126F7FFFFC59D27410BFFFFDF3FC638411BF7FFFF61A027410CFFFFFF76C6384109F7FFFFFCA2274106FFFFDF88C63841F2F6FFFFBDA3274104FFFFFF8FC63841E8F6FFFF07A52741FEFEFFFF60C63841D0F6FFFFF3A72741FFFEFFFFFCC53841CEF6FFFFFDAA274102FFFFFF98CC3841ADF6FFFF19AF274100FFFFFF81CE38419FF6FFFF97B12741F7FEFFFF03D03841B6F6FFFFBFB02741F6FEFFFF0AD43841BAF6FF7FC0B02741F9FEFF7FCDD53841ACF6FF1F20B22741FBFEFF5F0AD93841AEF6FF7F0AB32741FBFEFF1FBAD93841A5F6FFFFD7B42741F7FEFFFF4DDA384194F6FFBFC9B52741F0FEFFBF7ADA38418BF6FFFF9BB62741F5FEFFFFBEDA384183F6FF9F5BB72741F2FEFF3FDFDA384181F6FFFF6FB82741EEFEFFFF38DB384178F6FFFF4DBB2741F1FEFFFF49DC384157F6FFFF69BF2741E7FEFFFFC1DD38413DF6FFFF89C12741E8FEFFFFACDE384131F6FF9F21C32741E9FEFF9F90DF384137F6FF7F2DC42741E9FEFFBFBCE23841F4F5FF9FAFCB2741DAFEFF3F1EE33841E4F5FFFF09CE2741DFFEFFFF82E13841BAF5FFFF7FD02741D3FEFFFFAFDE38419AF5FFFF11D32741D4FEFFFF6FDD384158F5FFFF35DB2741CEFEFFFF90DB384134F5FFFFB6DE2741C9FEFF5FDCDA38411EF5FFFFAFDF2741C4FEFFFFC1DA38410AF5FF5FF9E12741C3FEFF7F7EDA3841BEF4FFFF4BE92741BBFEFFFF65D9384195F4FFFF55ED2741B9FEFFFF07D9384189F4FFFF1FF02741B8FEFFFFCFD838416CF4FFFF97F12741B6FEFFFFA9D838416AF4FFFFE9F22741B5FEFFFF55D8384156F4FFFF3BF42741B2FEFFFFDBD7384152F4FFFF41F52741B0FEFFFF99D738413EF4FFFFCBF62741AFFEFFFF57D7384117F4FFFFBBF92741ADFEFFFF15D73841EAF3FFFF79FE2741A4FEFFFF95D63841B8F3FFFF050328419BFEFFFFECD538418EF3FF9F5006284198FEFFBF7CD5384170F3FFFF7308284192FEFFFF43D53841');
INSERT INTO site VALUES (4, 1, 2, 1, 1, 'Site 2', NULL, 'Superficie', 'Polygone', '0106000020E6100000010000000103000000010000004F01000055FBFFFF0D08274176FFFFFF161B39410AFCFFDF4ED2264190FFFF3FF3FA38419EFDFF9FCF492641C0FFFF1F81E83841B5361A02991C26410556BCEB8DDD3841CBE2E70B501C2641D3586955A3DD3841189BFB6AAE1B264127E9DE91A6DD384160507E91331B2641FE2B5F089EDD3841A2CBB54CC81A2641D73AB6B191DD3841842AFC8B361A26418DC68A3181DD38416A5D50A5CB19264132CE845055DD3841FFA82336321926418B9062CB40DD38412FB1989B7918264107990AF13FDD384151E88B12C1172641C76BD50E47DD3841CEC3881A4D172641222AFB3062DD3841F3DF274D27172641DD56C77F8ADD38417424D80A2E1726419F69EC7DB5DD38415DCA1AA55A172641A8E682D5CCDD38419CA78B8A22182641DB0FD1C1CDDD38411C1932E7F1182641D6E30AB3D2DD3841289B06F8C0192641F6B6414FF3DD3841BECC9A7A241A2641D4BA48740BDE384141EF10D7BD1A2641FE0B1CD923DE3841E2CAD1FBF91A264114D70B2673DE3841D04A6EA5001B26417A2B6E8CA2DE3841FC9E8373C21A2641CA9C9AC1CDDE38413796D7B96D1A2641E35DEB3CD1DE38413AC55676021A26415D25AD0EB9DE3841FCE11251AE192641082F77D7A8DE3841EF1C202D24192641F660BB8094DE3841C9D05398C0182641C0F8543B80DE384156F8EB6C4D182641DE6275D37BDE3841C3BA7958FA172641562B7DED8DDE38410AFEFFFF2B182641CBFFFFFFB4DE384117FEFFDF59182641D0FFFFDFE2DE384110FEFFFFCD182641D2FFFFFF56DF3841692BD6028F18264151C337FCAADF3841F1145C88AB1826414865233DB8DF3841A1A02588D81826411526CFC4F3DF3841A626D0BAD718264115495A261FE038414DE36B0505192641FB0EC7DA4AE03841C1ED06AD41192641C836087D7EE038419A10C8F838192641CCFE31CDB1E03841B8C75DAE111926413D6C27F9E4E038417C2A21F42E19264158CE86292CE1384131EE466134192641CC3B3F9835E138411C2A42CE4C1926414B9355A75FE13841F9400A332D19264141C4BF008BE138413497CCE81419264145471112CEE13841D1434DE3131926412C6BFA4A05E238415A5FDC708E19264172E3538B1DE23841E90D03CFA31A26413E240049FFE13841257673EA6B1B2641A83D895EF4E138416BA0331AFE1B26412C6BE213EDE13841F07456A6AE1C26415CD8E4B8FDE138415C91FAB6DB1C2641A3047B1C41E238414FD8AAB97E1C26413742103960E23841526F2489311C26417A2E1FB16FE2384150C0BFDBAE1B2641D8F0200E77E238417719CC423B1B2641D9BAB8607EE238417596FE2BB01A2641119DB73AA9E238410B43BEDD331A2641B1C32BB5EFE2384123DB7E6C601A264146BFABEB42E338412FADDAE96E1A264160DE5A5F6EE33841F30C6D54471A2641CE3A8B5EB1E33841488C2AECF9192641FEFD0EAECCE338418D91D2DD48192641AECFF1B3D7E33841323ECA18DD18264161B94E30DBE338416605562181182641645078CFCEE338415E51389BFE172641BE335B5DC2E338412B84012A10172641D667DC1ACDE33841D7A11532C31626419877CFBBD0E338418EE212E44F1626413AAED457C8E338418F07C282CD1526414355BCC5BFE3384178EF94034315264172770F22BFE338413E4A7745C014264187739887BEE33841EA74BF733D142641967BADC0CDE33841D6B013A3C91326412F417F07E1E33841884CAE4D8B1326416FD3531814E4384101EA34C14C132641F4EAE82847E43841B4E6A9C91D1326412D9DE84F76E4384188F56ED3A91226416134DC499DE438410511A9541F1226414E1A75A69CE438419BBCF918AC11264167F8891E9CE438417DBB5B82F31026417378E3449BE43841E41778FC70102641A65470D38EE43841AE343043FE0F26417C2512A172E438417E3F95BFC10F264175C25FFB42E438411C6F4B8B370F264181A4048532E43841B9872F2E580E2641772B3E2D49E438419E2145E2BD0D2641BE73D42264E4384188592676420D2641EAB0D0407BE4384111AA6D85DE0C2641A18243CB7AE438418960A1A8350C2641BE971C2D6EE4384160A895EFD10B2641B6A84BE061E43841AB4CD73D660B2641D64BBB6161E4384136C1DF5F110B26418C7C32AD78E43841C8FC47DD850A2641A1669F5FAFE43841D7775A705E0A2641827F4367EAE43841B345BD24A30A2641F749246702E5384186FC189AEF0A2641380D25701AE53841B6092937150B26412415161F42E53841DA418F5D2C0B26412094D70B54E53841A399A2962E0B2641BC90A9C167E5384115978B21120B2641B721CECB74E5384187E5DF6ED40A26412E0B47D379E53841EA4173839E0A2641B7D1E78F7DE538414858CB6A7D0A2641EF7A0D6D79E53841138A570E570A26411D1465BC6EE53841D5788AD1230A26412DBE392C6DE53841EADFBC29EE0926414DD734416EE53841025414C8D60926416ECA5FAD74E53841DD835F3FC7092641F2A9B6C681E53841F703CFEEC60926414CA9E5ED92E538414F77908AD3092641AA6A4124A4E53841933150BEDF092641270667C1BFE538415D73F648C809264102C75F1DD6E53841B4E7DEAEA609264134A681CDE1E538414CEA35CF82092641F65D022BE8E5384162B1BD414A092641D539928CEEE53841073C71941909264100266E53EEE53841A8E5A770E6082641B92F7373E7E53841087BEABCB0082641ECCCCF58DFE53841580730B887082641F4064F5CE4E538415F65C03070082641EC47DA97FEE53841FD098A066D082641D969413B1EE63841C02F0D9855082641A761F32633E63841456AA0603E082641D679A5573CE6384197C1FEAC2408264160AC211940E638410FAB0045EC07264194A9F7823EE63841EDEFFC38D007264116E4763235E6384156BCCA4795072641EB965BF130E6384144A6B29F7B0726411978D7FE3DE638415D417FFF590726412D36FB024BE63841E647139D38072641B92AD5DB4AE63841848A536B12072641E2BB6FD342E638413CC1BB97E40626417BDE241E34E638418FA4DFE3C5062641143630AA2EE63841647F2C04A2062641B794814C29E63841B8D9E717790626416CF1891C29E63841C08BCBE05C062641ED1D78FB28E63841E755B5E8380626412F9650D128E63841AE17A78512062641FFA64F4C2BE638418558D9BAD405264180227F8735E63841088A48CB7A052641AC96547D47E63841640905E5560526417A10384B4FE638412ABFD6F3410526412E733FB25DE638412CE17D1B32052641D5B176D67BE63841C5C6E7C43105264180B698518EE63841D324BA4F3105264126253554A7E6384129807C7726052641F3F0A1F2C2E638411102C9FC0E05264178E24986DAE638415042EA23F5042641E90A983FE6E63841F254BBBACE0426419040940EEAE638413D8A754CAD0426416EC61373ECE6384191D4255B77042641C88ADF83F1E63841255F756F3C0426411DA1D6E2F7E638415915CE331304264133EA31E6FCE6384111B2E93AE5032641E7DCC328F6E63841D54EAAD3B6032641E7B4A7FD06E738416C55871B7E0326417EEFD18E16E73841FA97CD0A3E0326410BD4CF931BE73841A2F21B0703032641E7C4C34E1BE738416B9C9F59C8022641574D2C6614E73841A236A1B89202264180E9DE4F08E738417CD8221D740226416A6F7DA8FDE63841DCB5D43041022641B6216BF1EAE63841B1CA389C0B022641CF573733DCE63841BEA2ECB5DD012641F15BF879D1E63841E46560C1B20126419FA3FF10B3E638411F9FD5F48E012641B0733A9BA9E638417D8ACE595E012641A38EC882A5E63841BB8DA16D350126413E57F552A5E6384184DE7A2419012641ABFB8911A9E63841FED0FA96DB002641809EF83DA6E63841808886E2B70026414E27476CA3E63841296CDE549100264147153D3FA3E638419DAA44506D002641D9D7B594B1E6384196FCC89C53002641D5F25256B5E638415EC0DC26280026413AF1EA97B2E6384136F2F5521100264160B05B89A6E63841ACCBC5F4F7FF25411371850898E638410D970865EBFF2541BF755A2A84E6384139C069EDDEFF2541A3773DF076E6384114A65972B8FF2541EEC157C772E63841E2D88BC49EFF254140C9565175E63841689683C591FF254193A2B21585E638416B4EBE7C84FF25415CBFAFD598E63841910CAAB66AFF2541C86A3293A0E63841F0C798AB3CFF2541F3B578B59DE63841B857F2D025FF25410406381793E63841DD4C052AF5FE2541093C728A91E63841A14F7350CCFE254111CECE5E8DE63841B5708078A0FE254166A696CF93E63841BE09248677FE2541E0CECCF394E6384178547F5B5BFE254185FEF52A92E638413651362A3AFE254131C0A98087E63841D0F0D94923FE25413DF30E1A7EE63841EEF5DC94FFFD25417163C3647BE638417140E34BCCFD25417F6AEF7C7CE638416B48C79FA5FD2541446971D782E63841856BF61D7AFD2541B24EB5A482E6384196A8DFA149FD25414E339AE877E6384114EDD9691EFD2541A9B3B0E267E63841BA829919F8FC254162707A8A5AE6384131E78E20CAFC25413B8448CD53E638417BD67E5494FC2541A6649BE650E63841623893B270FC2541986E24194AE63841D49945934FFC25419D0D588F3BE638414DBA46AD26FC254124D1B30B3AE638410F9BBE52F8FB2541C6FCE53848E63841E30C76DEBFFB254122E91E4B49E63841CCD12F3D8AFB254135C518353DE63841D7D6130564FB25412294FA8036E63841D3D4D93740FB25418C87B4272DE638412782C16B05FB254130545AEF20E63841B592BD65CDFA254195408F2A16E638415CECE7F59CFA25416DC0A1C608E63841B5FFC75A6CFA2541AA046DAE04E638410A16AC6A40FA2541CD8DD75210E63841B3A83A0329FA25412AE9BFEA23E6384198946AED0EFA2541A7B57CCF3CE63841358F9FC4D3F9254169A21F5A50E6384180A4A6F9A7F92541D9AFCC0654E63841721DCA7F74F92541DC0D77A25FE63841A57BAB8150F92541456022A46CE638414AB58D1334F925413B9A9D5A78E63841D53CCA2E1FF92541017ABF0D90E63841B43E6EF911F925412EA290B59FE6384152C2BE97FAF82541F53ADB15B2E63841147E22AFDDF825411B77DC22D8E63841D5CCBEC4C8F82541A1FB9F0DF1E63841AE82F374C8F825410DD9C23402E738417C7E8CA7D7F8254168539A5113E73841C646C86FEEF825410D18A0EB21E73841EB289A45F8F8254153D193CA31E73841743EAFD0F2F82541062DBE9741E73841F3C59893D6F8254113AE6FA24EE738412DD170C4A2F82541F29FE29C6CE738413313F8B48DF825416B3DDAA781E73841B2527AEE8AF825410533BDFF97E738412CFC1D629FF725417EB9D83D88E7384159FEFFFF7BF72541D6FFFFFFC3E7384159FEFFFF7BF72541D4FFFFFF46E8384151FEFFFFFDF72541D2FFFFFF25E9384153FEFFFF6DF82541D1FFFFFFE5E938415BFEFFFF8FF72541D2FFFFFFB9EA38415CFEFFFFB3F52541D4FFFFFFCDEA384163FEFFFF37F32541D6FFFFFF14EB384161FEFFFF8FF12541D7FFFFFF9EEB38416DFEFFFF4FEF2541D5FFFFFF54EC384174FEFFFF81EC2541D3FFFFFFDCEC38416CFEFFFF2DEA2541DCFFFFFFC5ED38416EFEFFFF13E92541D8FFFFFFD5EE38416CFEFFFFF5E82541D3FFFFFF68EF384177FEFFFF3FE82541DBFFFFFF1EF0384181FEFFFF7FE72541D7FFFFFF83F0384170FEFFFF09E72541D3FFFFFFC4F038417EFEFFFF1FE62541D1FFFFFF51F1384183FEFFFFEBE32541D5FFFFFF71F238417EFEFFFF01E32541D3FFFFFF55F338417CFEFFFFD9E12541DCFFFFFFE7F3384192FEFFFF21DE2541D8FFFFFF93F5384194FEFFFF03DA2541DAFFFFFF48F738419EFEFFFF9BD52541D6FFFFFF13F83841A0FEFFFFEDD32541DAFFFFFF40F83841A5FEFF9FF4D32541D4FFFF3FC6F63841A2FEFFFFABCF2541D8FFFFFF79F73841A7FEFFFF0BCF2541DEFFFFFFC4F73841A1FEFFFFC5CE2541D9FFFFFF8DF83841A0FEFFFFBBCE2541DCFFFFFF51F93841A7FEFFFF81CE2541DCFFFFFFADF93841A0FEFFFF4BCD2541DCFFFFFF20FA3841A5FEFFFFE9CA2541DAFFFFFF99FA3841B6FEFFFF65C82541DAFFFFFF3AFB38414A873933D1C725411037373E47FB38411E0FD245D4C725414761268C4FFB38414C3C65D1CCC725413E417E51B8FB3841D67A505E19C72541EE68B23605FC384174C2B51684C6254119169E165DFC38415209BD0D37C525418CCABE7F94FC38417418F7C61BC42541D3B591C9B2FC3841EB002ECE55C225413235F7E577FC384177C11A0A2EC1254142D18E3E96FC3841A00F0A4165BF25419079BB1A07FD3841ACB66DE067BE2541A15E1A100FFD3841CEB8D65681BD2541B113BB3C16FD384151AA2FDA4EBC254147789DE686FC38416C67D7E569BA2541FA581B9825FC38419AA70738E4B62541631B6DD8AFFC38412EFFAD0281B52541F286A6DC18FD3841DA82503476B52541EEBFE0FD18FD3841B5FEFF9FA5C22541E0FFFFBF05033941A3FEFF9F9BD32541E1FFFFBFA40A3941F4C9C53583D3254143EA25DD161039419E1AF5CD87D3254175E99FBA18103941BC8C9A77B8F02541FFFD64EBF21B39418AEDF2802A012641096FACFA69233941F16238D0590D26410C5F2E58F228394155E6EB2A38122641D8FC9CC7192B39413F2952529C2A264115D34630E535394188411BD650472641126D9D372A433941DA1344DDFF6426413462E39B24503941AF3DC62FD2692641C4454EDD58523941A18B9301B08226411907E6A3B75D3941FDE20A01B89F264197AA5F3EDB6A39412C2893A8F4A8264118EBAF09356F3941ECFCFFFFCFBB26419CFFFFFF91763941EEFCFFDF54BD264196FFFFBF15753941E2FCFFFF1DC026419BFFFFFFC6703941DCFCFF3FF4C1264197FFFF9F886F3941CFFCFF5F92C4264195FFFF1FB46D3941B4FCFFFFCFCB264193FFFFFFCF6A39419DFCFF5F36CF264193FFFF7F356939419AFCFF7F70D1264191FFFF9F4468394186FCFFFF07D526418EFFFFFF976539417EFCFFFFDFD826418BFFFFFF6063394176FCFF5FAED9264192FFFF5FF862394177FCFFFFADDB26418EFFFFFFF46139415FFCFFFF3DDE264188FFFFFFBB6039415BFCFFFF29E0264186FFFFFF775F39414EFCFFFF03E226418CFFFFFF7B5D394146FCFF3FD3E226418AFFFFBFC85C39413BFCFFFFFDE4264189FFFFFFE85A394128FCFFDF19E9264187FFFFDF8958394132FCFF9F3AE9264187FFFFBF7358394113FCFF5FD5ED264181FFFF3F565539410AFCFFFF4FEF26417DFFFF1F565439419A533D28EBF1264121F20F1D444F3941BEFBFF5FE3FA26417EFFFF9FD03D39416AFBFF1F910A274170FFFF1F852F394152FBFFFFCB08274174FFFF7FEF1C394151FBFFDFB808274177FFFFDF261C39415EFBFF1F4D08274177FFFF1FE51B394157FBFFDF0B08274172FFFF1F171B394155FBFFFF0D08274176FFFFFF161B3941');
INSERT INTO site VALUES (5, 1, 3, 2, 3, 'Site 3', NULL, 'Superficie', 'Polygone', '0106000020E61000000100000001030000000100000001010000F0EEFFDFE6782841EAFDFF3F620C3941E0EEFF5F087A2841EBFDFFBF5B0C394197EEFFDFCF842841D4FDFFDFB21E39418CEEFFFF22872841CCFDFF1F1823394188EEFFFF63872841D2FDFFFF9E2339418BEEFFFFDD872841D3FDFFFF8424394184EEFFFF3B882841CCFDFFFFAC25394188EEFFFFBF882841CFFDFFFF0C27394192EEFFFFE5882841D0FDFFFFFC2739419CEEFFFFC9882841CDFDFFFF11293941A5EEFFFF89882841CBFDFFFF8C2A39419AEEFFFF91882841CEFDFFFF012B3941A6EEFFFFB7882841CDFDFFFF982B3941A8EEFFFF03892841C8FDFFFF662C3941A1EEFFFF61892841C9FDFFFF3F2D3941ABEEFFFF7D892841CDFDFFFF0D2E3941A9EEFFFF69892841CDFDFFFF522F3941CCEEFFFFB7882841CAFDFFFF4A333941E5EEFFFF4F882841CBFDFFFFE5353941E5EEFFFF21882841CDFDFFFFA437394109EFFFFFB1872841D0FDFFFF983B394103EFFFDFA7872841D0FDFF7FB33C3941D4EEFF3FD68D2841BEFDFF3FCF43394186EEFF1FB8992841ACFDFF7FA4543941FCEDFFBFEDA828418EFDFFBF7F643941F2EDFF3F9AAA284183FDFFFFD16639419193C8CB9CAA2841BB41A1CED5663941312776FA4EBA284194D285A23B6439410B2D780660DC2841200172D6955E3941A4E82B5D61DF2841070D355E165E3941965D83D97304294199FCEC25F157394132EE2C0041132941CE8108D87C55394120E6FFFFB516294183FCFFFF9B543941B9E5FF5F081B294171FCFF9FBD5239412D1E928C001B2941EE07F0FD3354394195EF2B12051B2941C918D83D33543941F337FC7186292941D2D73CC0CB5139417ECEE88AF030294197B3A91491503941C79828B45A3829412A188C71564F39411FF566B7C43F2941E85028BA1B4E3941297834CA2E47294184779027E14C39414C497824994E29411A57CB9DA64B39414EB3487EC9532941A1DFEE4CCA4A3941604F7923D7632941E25F1CF020483941AEBD7350AB7329411336F22E81453941C8F67D69457E294170BB311EBF4339415AC4E94540972941EA0A58369B3F3941C52A6DCFBD982941D01C38025C3F394140BB9B5F7C9E2941F58CF81D683E39416BE0E519EEA82941260500E6AC3C3941181A9D34FCAE29417C54D6E4AB3B39414A0880DF22B22941A6A4AC32263B3941C8F5B82D66B6294117929540713A39419A7190C09BB82941741E057E133A394176366C6ED0BD29411E7715A536393941BFDD4DFD08BF29416A4E09D502393941DF7C5ACA6FC229414C1A5A70723839410A2DE50CDFC22941D88EE4F65F383941A8A5B35BCDDA2941E627E24F68343941A24B386190DF2941F3D9643D9E3339411E3A5D4D89E02941D562F8F674333941BACEFF3F6CE129417EF9FF9FD22E39411A9F6C2D70E1294133721BFEEE2D3941D5DB0B0766E02941A7B6E478582D39414C4F13BD1EDF29419C39A64E9F2C3941B1FA0DC48BDD294134A53063BB2B39412C7E9DFD1DD62941138A5AE6872739412150C43013D4294111D8F53760263941BA87C388FFCD2941CF02659146233941128E27698FC92941F2C6050003213941A42841D3C9BC29410D66A86A7F1A394186C46F9931BB29411780963BAF193941DE8B0C6A16BB294128556D4DA1193941EC06526864B12941432972A0AF1439419E85AA2115BD29415BC958FC710B39410ED2FF3FB3BC29412FFAFF5F710B3941DAD7FF1F4C8E2941EFFAFF1F660B3941CDD7FF5F628E2941F4FAFFDFB30A3941DAD7FFBF998D2941F1FAFFBF0C0A3941F4D7FFDFBA8C2941FBFAFFBF7009394107D8FFDF828B2941FCFAFF3F6508394122D8FF5FC28A2941FCFAFF7FA80739412FD8FF3F73892941FEFAFFBF3006394140D8FFFF4C88294109FBFF3F7C04394175D8FF9F0C8629410DFBFFBF7F0239417FD8FF9FAB8429411AFBFF5F870039419ED8FFFF7C83294116FBFF7F5CFE3841B5D8FFDF1B8229411FFBFF5F60FD3841ABD8FF9F848129411EFBFF9FB3FB3841DED8FF3F8C7F294129FBFF1F3DF93841D5D8FF5F277F29412DFBFF5FF5F73841EAD8FF9F5D7E29412FFBFFBFC6F63841DAD8FF3FC67D294134FBFFDF9BF43841EED8FF7FFC7C29412EFBFF5F08F33841E4D8FF3F657C294139FBFF9FDDF03841E6D8FFBFD17A294139FBFFFF6AED384110D9FF7F7478294141FBFF7F11EA384128D9FF5F1377294150FBFFFFFFE738414FD9FF7F4D75294158FBFF1FB8E6384181D9FFBF227329415CFBFFDFBBE5384195D9FFFF5872294156FBFFFFD8E43841ADD9FFDFF77029415FFBFF7FC3E33841B5D9FF9F6070294163FBFF9FE0E23841AED9FF1F2E70294161FBFFBF98E13841C2D9FF5F646F294162FBFFFFCEE03841D5D9FF3F686E29416DFBFF3F05E03841D8D9FFDFD06D29416CFBFFFF6DDF3841E1D9FF9F396D29416EFBFF3FA4DE3841F5D9FFDF6F6C294171FBFFDF0CDE3841F5D9FFDF6F6C29416FFBFFDF29DD3841F8D9FF7FD86B294179FBFFDFC8DB3841DBD9FF5F3D6C294172FBFF5F35DA3841BED9FF7F416C294170FBFFFFFBD738411ADAFF9FB56829417CFBFF7F6DD6384153DAFF5F3366294186FBFF1F00D5384163DAFFFF556529418CFBFF3F7BD4384190DAFF7FDD63294190FBFFBF92D338418DDAFF5F2C63294191FBFF3FB5D238419DDAFFDF3862294193FBFF3F7FD13841BBDAFF3F456129419AFBFFDFA1D03841DADAFF5F2560294196FBFFDF06D03841E5DAFF5FEF5E29419CFBFFBF55CF384114DBFF5F1E5D2941A7FBFF1F62CE384132DBFF3FD25B2941ADFBFF1FC7CD384160DBFFBF595A2941B3FBFFBFE9CC38418EDBFF5F46582941B6FBFFBFB3CB3841AADBFF5F75562941BEFBFFBF88CA3841C9DBFF3F29552941C3FBFFDF5DC93841E3DBFF9F9A532941CFFBFFFF3DC8384102DCFF7F4E522941C9FBFF9F6BC7384130DCFF5F67502941CDFBFF1F83C638416EDCFF5FFB4D2941D8FBFF5F79C5384188DCFFDF824C2941E3FBFF9F6FC43841E0DCFF1F72482941EEFBFF9F93C2384133DDFF7F73452941FBFBFFFF1CC1384156DDFFBF9143294102FCFF1F39C0384175DDFFFFE341294104FCFF7FBDBF384198DDFF5F5040294102FCFFBF27BF3841ACDDFF1F8D3F294107FCFF7FBFBE3841BEDDFFDFF03E294107FCFFDF6ABE3841CFDDFF9F613E29410EFCFF9FDBBD3841CADDFF5FF93D29410EFCFFFF86BD3841CEDDFF5FC53D29410FFCFF5F18BD3841CBDDFF3F913D294110FCFF3FBDBC3841CDDDFF3F773D294114FCFFFF61BC3841CBDDFF3F913D294112FCFFBFC5BB3841CBDDFF1F363D294112FCFF7F0FBB3841DADDFFFFCC3C29410DFCFF9FA4BA3841C9DDFF9F563D29410BFCFFDF09BA3841B0DDFFBFBD3D29410EFCFF1F19B93841A5DDFF7F023E294112FCFF7F39B8384194DDFF1F8C3E294108FCFF5F26B7384177DDFFDFD03E294110FCFFDF46B6384172DDFF7FAE3E294113FCFF3F67B538417EDDFFBF693E29410EFCFF5F65B4384179DDFF5F473E29410CFCFF1FA8B3384175DDFFFF243E29410BFCFF9FC8B2384162DDFFFF243E29410EFCFF7F0BB2384162DDFFFF243E29410CFCFF3F4EB1384157DDFFBF693E29410FFCFF1F91B038414CDDFF7FAE3E294109FCFF7FB1AF38413ADDFF7FAE3E29410DFCFF9FAFAE384144DDFFBF693E29410DFCFF7F9CAD384146DDFF7F023E29410CFCFFDF66AC38413DDDFFBFBD3D294111FCFFFF64AB38415BFB21E6D4CE28419A66DEA5F1AA384199EAFF1FD19F2841A1FDFFBFC0AA384191EAFFFFF79F2841A7FDFFFF20AB3841BEF323196FA02841CC4082A832AC384195EAFFFFA9A028419EFDFFFFB9AC38418CEAFFFFCFA028419FFDFFFFD7AD38419FEAFFFFF3A028419CFDFFFF5AAF384196EAFFFFE1A0284199FDFFFF41B03841AFEAFFFF4BA02841A4FDFFFF29B23841B6EAFFFF1BA028419EFDFFFF77B33841C0EAFFFF09A02841A3FDFFFF33B43841CAEAFFFF25A02841A4FDFFFF23B53841C1EAFFFF41A028419FFDFFFFDAB53841CAEAFFFF25A02841A6FDFFFF46B63841DAEAFFFFAB9F2841A2FDFFFF8CB73841E2EAFFFF579F2841A4FDFFFF50B9384105EBFFFFD39E2841A5FDFFFFCFBB384105EBFFFFD39E2841A2FDFFFFDFBC3841FDEAFFFFF99E2841A1FDFFFF5ABD384108EBFFFF4D9F2841A3FDFFFFCFBD3841FAEAFFFF6FA02841A1FDFFFFB3BE3841DEEAFFFFE7A128419EFDFFFFB1BF3841C9EAFFFF39A32841A1FDFFFFD9C03841AB176BCE52A32841250A7741F6C03841C7EAFFFF8BA428419BFDFFFF5AC23841B2EAFFFFA5A5284193FDFFFFF8C33841B5EAFFFF85A6284196FDFFFFB4C53841B1EAFFFF8BA728418FFDFFFFA1C73841ADEAFFFF6DA8284191FDFFFF8EC93841A6EAFFFFCBA828418BFDFFFFD7CA38419FEAFFFF57A928418CFDFFFFFFCC3841AAEAFFFF7DA9284190FDFFFF2ECF3841B4EAFFFF6BA928418EFDFFFF69D03841C4EAFFFF1FA928418FFDFFFF54D13841C7EAFFDFE2A828418DFDFF3FE0D13841D4EAFFFFA5A8284192FDFFFF6AD23841FDEAFFFF5DA7284190FDFFFFF9D438410CEBFFFFD9A6284194FDFFFF42D638410CEBFFFFCFA628418FFDFFFFE7D6384116EBFFFFEBA628418DFDFFFF74D738410EEBFFFF3FA7284192FDFFFF30D8384106EBFFFF93A7284190FDFFFFF8D8384110EBFFFF8BA7284193FDFFFF89D938411AEBFFFF9DA7284191FDFFFF8EDB38411AEBFFFFCBA7284193FDFFFF5FDD384114EBFFFF6BA8284188FDFFFF2EDF38411FEBFFFFBFA8284189FDFFFFB0E038411AEBFFFF69A928418FFDFFFF73E238410E5D976BB4A92841EFFEDC625AE3384126EBFFFFC7A9284187FDFFFF96E3384128EBFFFF2DAA28418EFDFFFF30E538411FEBFFFF53AA28418DFDFFFF8CE6384129EBFFFF9DAA284186FDFFFFD0E7384122EBFFFFCDAA28418BFDFFFF8CE8384121EBFFFFF1AA28418DFDFFFFE5E838411CEBFFFF63AB28418AFDFFFF51E9384119EBFFFF7DAC284187FDFFFF1CEA384113EBFFFF13AD284187FDFFFF8AEA38410BEBFFFF67AD284186FDFFFF1CEB384116EBFFFF8DAD284186FDFFFFFDEB384118EBFFFFFDAD284181FDFFFF67ED384110EBFFFF51AE28417EFDFFFF86EE384114EBFFFFDFAE284188FDFFFF90EF384114EBFFFFB1AE284185FDFFFFE5EF384128EBFFFF83AD284186FDFFFF1DF0384158EBFFFF53AA284186FDFFFF34F038416CEBFFFFEDA8284191FDFFFF3EF038417CEBFFFF7DA8284190FDFFFFCBF0384176EBFFFFE5A828418EFDFFFF22F238417AEBFFFFF3A928418CFDFFFF27F538417EEBFFFF49AA28418CFDFFFF12F6384186EBFFFF51AA28418AFDFFFF7EF6384187EBFFFF2DAA28418EFDFFFF07F738419FEBFFFF8DA928418AFDFFFFAEF83841ADEBFFFF99A828418BFDFFFFD1FA3841BBEBFFFF0BA8284190FDFFFFA9FB3841CBEBFFFF59A728418CFDFFFF86FC3841E1EBFFFF49A6284193FDFFFF84FD3841F0EBFFFF97A5284190FDFFFF2BFE384102ECFFFF55A5284197FDFFFF97FE384102ECFFFF27A528419BFDFFFF20FF38410BECFFFF0BA528419AFDFFFFC4FF384109ECFFFFC9A4284199FDFFFF560039411FECFFFFDDA3284198FDFFFFAD01394160ECFFFFC7A1284199FDFFFFB604394166ECFFFF31A12841A1FDFFFFDA0539418CECFFFF9D9F2841A0FDFFFF00083941B9ECFFFFAB9D2841A3FDFFFFD30A3941F8ECFFFF259B2841ABFDFFFF310E394119EDFF3FF5992841A8FDFF5F25103941E5EEFFBFD8782841EDFDFF9FA60B3941F0EEFFDFE6782841EAFDFF3F620C3941');
INSERT INTO site VALUES (6, 2, 3, 2, 4, 'Site 4', NULL, 'Superficie', 'Polygone', '0106000020E6100000010000000103000000010000004100000053F4FFDF4B01284199FEFFBF13023941F2F4FF3FE5F12741B6FEFF1F68003941EEF4FFFFC1F12741B7FEFFFF9EFF3841BCA3B59DB9F12741A50654D688FF3841EBF4FF9FB3F12741B5FEFFFF78FF3841F5F4FFDF92F12741B6FEFFDF22FF3841E8F4FF9F67F12741B2FEFFDFB0FE3841F4F4FFFF42F12741AFFEFF3F50FE3841F7F4FF5FBAF02741B2FEFFDF8AFD3841F8F4FFFF81F02741B6FEFFFF3BFD3841FCF4FFFF81ED2741BCFEFFFFFAFA384112F5FFFF39EB2741BEFEFFFF11F938411BF5FFBF6AE92741C0FEFFDF48F7384121F5FFDF01E92741BBFEFF7FE1F6384127F5FF5FCEE82741BEFEFFBFABF6384128F5FF5FBAE62741BDFEFFFF50F438414CF5FFFF3BE32741C6FEFFFFC9F238414EF6FFFFF6C62741DEFEFF1F25F738416DF6FFFF64C52741E4FEFF5FA1F8384194F6FFFF01C12741E9FEFFFF21FB3841E0F6FFFF41B82741EEFEFFFFE1FF38418EF8FFFF8D7A274128FFFFFF16EF38415FF9FFFFB156274148FFFFFF62E63841342B12378F1C27415F855A305BE6384146FBFFFF61FD26417EFFFFFF56E638413EFBFF3F000027417CFFFFDFB2EC384144FBFFFFA300274175FFFFFF6AF0384144FBFFFF6B0027417FFFFFFFFEF1384144FBFFFF6B00274175FFFFFFB1F238413BFBFFFF910027417EFFFFFF3EF3384139FBFF1FED02274179FFFF3FC5F5384132FBFFFFCB0327417BFFFFFFCDF638412FFBFFFFE504274174FFFFFFADF8384136FBFF7F8B05274177FFFFDF32FA38413AFBFF3FCC05274170FFFF3FCBFA384136FBFFFF1106274177FFFFFF6EFB384139FBFF7F3306274178FFFF5F21FC384133FBFF7F5606274178FFFFDFDAFC384140FBFF5F5606274172FFFFDF72FF384139FBFFFF9506274173FFFFFF1C00394133FBFF9F5207274174FFFFDF0801394139FBFFFFFB0727417AFFFFFF170239413BFBFFFF6B08274172FFFFFF2803394133FBFF9FA108274179FFFF3FB404394136FBFFFF1509274172FFFFFF340639412AFBFF9F2A0C274170FFFF9F3007394129FBFFFFCB0B27416FFFFFFF7E0A394129FBFFFF030D274174FFFFFF9B0B394135FBFFFF950A274170FFFFFFEB0C394139FBFFFF6B0A274176FFFFFF120E39413AFBFFFFC709274179FFFFFF630E394146FBFFFF250A274176FFFFFFA60F394140FBFFFF690A274173FFFFFFB610394136FBFFFF290B274176FFFFFF8912394138FBFFFF990B274177FFFFFFB413394144FBFFFF6D0B274175FFFFFFD814394142FBFFFFA10A274179FFFFFF661639414EFBFF9F330A274172FFFFFF1D18394155FBFFFF0D08274176FFFFFF161B394168C40F7921482741E63F6A6CE71F3941DDF6FFFF1FC72741DDFEFFFF712939419FF5FFFF19E92741B9FEFFFF951D3941CCF4FFFF6FFF2741A4FEFFFF951F394160F4FF1F49012841A3FEFF5F3F02394153F4FFDF4B01284199FEFFBF13023941');
INSERT INTO site VALUES (7, 2, 5, 2, 3, 'Site 5', NULL, 'Superficie', 'Polygone', '0106000020E610000003000000010300000001000000040000007424D80A2E1726419F69EC7DB5DD3841F3DF274D27172641DD56C77F8ADD38413AF783790E172641D620ACF8A4DD38417424D80A2E1726419F69EC7DB5DD38410103000000010000000C0000000AFEFFFF2B182641CBFFFFFFB4DE3841C3BA7958FA172641562B7DED8DDE384110AF5CD99B1726418C895184A2DE38418AA66F64551726410F3CB83EE9DE3841DE092B7DB01726412376D3FC24DF38413681BCB5DD172641040DC39054DF3841661862831A182641ED1A273B80DF38412A14CAF866182641B453286198DF3841692BD6028F18264151C337FCAADF384110FEFFFFCD182641D2FFFFFF56DF384117FEFFDF59182641D0FFFFDFE2DE38410AFEFFFF2B182641CBFFFFFFB4DE384101030000000100000074000000A2FEFFFFABCF2541D8FFFFFF79F73841A5FEFF9FF4D32541D4FFFF3FC6F63841A0FEFFFFEDD32541DAFFFFFF40F838419EFEFFFF9BD52541D6FFFFFF13F8384194FEFFFF03DA2541DAFFFFFF48F7384192FEFFFF21DE2541D8FFFFFF93F538417CFEFFFFD9E12541DCFFFFFFE7F338417EFEFFFF01E32541D3FFFFFF55F3384183FEFFFFEBE32541D5FFFFFF71F238417EFEFFFF1FE62541D1FFFFFF51F1384170FEFFFF09E72541D3FFFFFFC4F0384181FEFFFF7FE72541D7FFFFFF83F0384177FEFFFF3FE82541DBFFFFFF1EF038416CFEFFFFF5E82541D3FFFFFF68EF38416EFEFFFF13E92541D8FFFFFFD5EE38416CFEFFFF2DEA2541DCFFFFFFC5ED384174FEFFFF81EC2541D3FFFFFFDCEC38416DFEFFFF4FEF2541D5FFFFFF54EC384161FEFFFF8FF12541D7FFFFFF9EEB384163FEFFFF37F32541D6FFFFFF14EB38415CFEFFFFB3F52541D4FFFFFFCDEA38415BFEFFFF8FF72541D2FFFFFFB9EA384153FEFFFF6DF82541D1FFFFFFE5E9384151FEFFFFFDF72541D2FFFFFF25E9384159FEFFFF7BF72541D4FFFFFF46E8384159FEFFFF7BF72541D6FFFFFFC3E738412CFC1D629FF725417EB9D83D88E73841473C762836F72541FEB9CE3381E738418EAE081772F62541385358C560E73841EF989D55A2F52541492A38E813E73841CBC19D231DF52541D7BD2588A1E63841742FDBD4E1F425418D80FFDF22E6384170907ABF5CF42541D2A73C31AAE5384195B2DB39A6F325419F802B9837E53841CB9EBC08F9F1254183F94675F6E43841D21FD79170F025415F4E792EAFE43841BB3B265EF4EE25411CCC249474E4384162992FE139ED254195712DA85FE43841E6F26C521FEC25410FEDFF0945E438412A600AB3E8E92541F431335F7BE438410044263090E825414BBA3D2180E43841F65981DC44E7254162B16E7B52E43841514C7E70C8E525412FF054E317E43841F069B1250DE42541EC0C76BF3BE43841EE5D02B346E32541E26D086593E438418418F3BF73E22541E22C299AF7E438416BB0B17B57E12541641F3A7248E5384157EF7E743BE02541E2101D0F80E53841BD96683337DE2541EBD7F82171E53841D11CED068CDD2541F5D8AD2C31E53841AF6495A37EDC25416E7F29C7F0E43841B72E48DC7CDB25419159BDAAC9E43841142849FA94DA25414C9EBC7A63E4384190D6442BFDD92541547622AF48E43841C60A5F6C59D92541F7A23AED32E438410A18C32CB6D82541559F8D580DE43841A1045C513CD825411B893F9CCDE33841831875B1A4D72541F4BC55C053E33841712357F051D425417A2C49C5D4E33841AB1D4F6B76D325410469DAFC12E43841167FEDB4BCD2254123F7BDF85DE4384158D6F62827D22541E6DBB275C2E43841A1BADFF1AAD125412B28B06807E538416E67B332CDD025410608D07519E53841EADCCDB8FBCF2541048E6F1238E53841E5315F6967CF25417293E51057E53841EC29FD580FCF2541B63E85C0CEE5384150284D49E8CE2541B636DB5840E638412A3A185A5FCE2541CB0E2C799EE63841228D267AE3CD25418E4A1E80D0E6384195526A07B1CD25418697E4151CE73841C13B0E20AFCD254100EA7A8987E738412EF8E29D87CD254178E2317912E83841C83FE73692CD254170E0DA4071E8384133A2BFA55ECD254103689006FCE838414A1E7033F9CC2541779E7B3AA6E93841CA2F2B24BACC2541087EF4CA04EA3841F6C63BDE61CC2541A237657A7CEA3841022875AE52CC254135613BC120EB3841FD195DD912CC2541B4D044DB9EEB3841BD091EA3AECB254183BD869003EC38416744A2AACDCA25418CC6F0C2CCEC38412FCE3BE64FCA2541E8C5983D6AED3841C03AC085DEC92541ED70165B01EE384125B2455A85C92541AAB1C23AB8EE384103FFD4CE39C92541571926BD16EF384101A46A2F2BC925415043D55D9BEF3841AB145EDD7EC925414BE911D926F0384144F1BE0389C9254140DE0DF89EF0384190353655E7C82541F47989FCFCF038410E25B0E014C82541BB7B4D9754F138416EE21575B1C72541884B0F098DF13841FD2EDA9465C72541B3A2C277FEF13841314BE79163C7254130450D3A70F2384176E9D01021C72541A253FFEE85F3384128CC5CDF70C6254162DAA2FF6EF438410B35B106C5C625415A866E3196F53841996ADF4B85C625413C7812180FF63841C5DBD4DCCAC625414A65427988F638416E1F137639C72541AB762C7507F73841CE0D075EB2C72541195E03DD7BF738415C3B02C1E3C72541A33E1054E5F738410D7D74BA8EC72541661A5A808DF838413A15198955C72541AE84AF6463F938416AEDDD3574C72541F9E775CBE3F93841F55EDEDB90C72541E2CB69FE5CFA3841C89D013AADC7254184EC7004E6FA38414A873933D1C725411037373E47FB3841B6FEFFFF65C82541DAFFFFFF3AFB3841A5FEFFFFE9CA2541DAFFFFFF99FA3841A0FEFFFF4BCD2541DCFFFFFF20FA3841A7FEFFFF81CE2541DCFFFFFFADF93841A0FEFFFFBBCE2541DCFFFFFF51F93841A1FEFFFFC5CE2541D9FFFFFF8DF83841A7FEFFFF0BCF2541DEFFFFFFC4F73841A2FEFFFFABCF2541D8FFFFFF79F73841');
INSERT INTO site VALUES (9, 1, 3, 4, 11, 'Forêt classée', 103, 'superficie', 'Polygone', NULL);
INSERT INTO site VALUES (10, 2, 13, 5, 9, 'Forêt Doui', 48, 'superficie', 'Polygone', NULL);
INSERT INTO site VALUES (2, 2, 4, 7, 4, 'siter', 67, 'longueur', 'Ligne', NULL);


--
-- TOC entry 2872 (class 0 OID 0)
-- Dependencies: 271
-- Name: site_idsite_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('site_idsite_seq', 2, true);


--
-- TOC entry 2782 (class 0 OID 140051)
-- Dependencies: 272
-- Data for Name: souscategorie; Type: TABLE DATA; Schema: public; Owner: postgres
--

INSERT INTO souscategorie VALUES (1, 'Diguettes');
INSERT INTO souscategorie VALUES (2, 'Labour');
INSERT INTO souscategorie VALUES (3, 'Cordons pierreux');
INSERT INTO souscategorie VALUES (4, 'Zai');


--
-- TOC entry 2873 (class 0 OID 0)
-- Dependencies: 273
-- Name: souscategorie_idsouscategorie_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('souscategorie_idsouscategorie_seq', 1, false);


--
-- TOC entry 2784 (class 0 OID 140056)
-- Dependencies: 274
-- Data for Name: statutfoncier; Type: TABLE DATA; Schema: public; Owner: postgres
--

INSERT INTO statutfoncier VALUES (4, 'APFR Collective', 'Bail à ferme');
INSERT INTO statutfoncier VALUES (1, 'PV de cession/Mémorandum de cession', 'Contrat de location de l''Etat');
INSERT INTO statutfoncier VALUES (2, 'Titres fonciers', 'Prêt');
INSERT INTO statutfoncier VALUES (3, 'Titres fonciers', 'Bail à ferme');
INSERT INTO statutfoncier VALUES (5, 'Titres fonciers', 'Prêt');
INSERT INTO statutfoncier VALUES (6, 'PV de cession/Mémorandum de cession', 'Location');
INSERT INTO statutfoncier VALUES (7, 'Titres fonciers', 'Location');


--
-- TOC entry 2874 (class 0 OID 0)
-- Dependencies: 275
-- Name: statutfoncier_idstatutfoncier_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('statutfoncier_idstatutfoncier_seq', 7, true);


--
-- TOC entry 2786 (class 0 OID 140064)
-- Dependencies: 276
-- Data for Name: typecollectif; Type: TABLE DATA; Schema: public; Owner: postgres
--

INSERT INTO typecollectif VALUES (1, 'Association');
INSERT INTO typecollectif VALUES (2, 'Groupement');
INSERT INTO typecollectif VALUES (3, 'Réseau');
INSERT INTO typecollectif VALUES (4, 'Fédération');
INSERT INTO typecollectif VALUES (5, 'Confédération');
INSERT INTO typecollectif VALUES (6, 'Coopérative');
INSERT INTO typecollectif VALUES (7, 'Union');


--
-- TOC entry 2875 (class 0 OID 0)
-- Dependencies: 277
-- Name: typecollectif_idtype_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('typecollectif_idtype_seq', 1, false);


--
-- TOC entry 2788 (class 0 OID 140069)
-- Dependencies: 278
-- Data for Name: typesol; Type: TABLE DATA; Schema: public; Owner: postgres
--



--
-- TOC entry 2876 (class 0 OID 0)
-- Dependencies: 279
-- Name: typesol_idtypesol_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('typesol_idtypesol_seq', 1, false);


--
-- TOC entry 2877 (class 0 OID 0)
-- Dependencies: 281
-- Name: user_iduser_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('user_iduser_seq', 1, false);


--
-- TOC entry 2790 (class 0 OID 140074)
-- Dependencies: 280
-- Data for Name: users; Type: TABLE DATA; Schema: public; Owner: postgres
--

INSERT INTO users VALUES (1, 'igmvss', 'igmvss', 'igmvss', 'igmvss', '56 67 67 67', 'igmvss@igmvss.net', 'igmvss', 'dccbe1ecfe489c0f991bc15b603e8d3f', 1);


--
-- TOC entry 2779 (class 0 OID 140007)
-- Dependencies: 262
-- Data for Name: vegetalisation; Type: TABLE DATA; Schema: public; Owner: postgres
--

INSERT INTO vegetalisation VALUES (1, 'Plantation ligneuse', '');
INSERT INTO vegetalisation VALUES (2, 'Semis direct ligneux', '');
INSERT INTO vegetalisation VALUES (3, 'Semis direct herbacé', '');
INSERT INTO vegetalisation VALUES (4, 'Tapis herbacé', '');


--
-- TOC entry 2878 (class 0 OID 0)
-- Dependencies: 282
-- Name: vegetalisation_idvegetalisation_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('vegetalisation_idvegetalisation_seq', 1, false);


--
-- TOC entry 2778 (class 0 OID 139999)
-- Dependencies: 260
-- Data for Name: vocation; Type: TABLE DATA; Schema: public; Owner: postgres
--

INSERT INTO vocation VALUES (1, 1, 'Agricole');
INSERT INTO vocation VALUES (2, 1, 'Pastorale');
INSERT INTO vocation VALUES (3, 1, 'Sylvicole');
INSERT INTO vocation VALUES (4, 1, 'Cynégétique');
INSERT INTO vocation VALUES (5, 1, 'Agropastorale');
INSERT INTO vocation VALUES (6, 1, 'Agroforesterie');
INSERT INTO vocation VALUES (7, 1, 'Agrosylvopastorale');
INSERT INTO vocation VALUES (8, 1, 'Sylvopastorale');
INSERT INTO vocation VALUES (9, 2, 'Forêt Classée de l''Etat');
INSERT INTO vocation VALUES (10, 2, 'Forêt Classée des Collectivités');
INSERT INTO vocation VALUES (11, 2, 'Sites Ramsar');
INSERT INTO vocation VALUES (12, 2, 'ZOVIC');
INSERT INTO vocation VALUES (13, 2, 'Espace Communal de Conservation fonctionnel');
INSERT INTO vocation VALUES (14, 2, 'Forêt Protégée des Collectivités');
INSERT INTO vocation VALUES (15, 2, 'Conservation individuelle');


--
-- TOC entry 2879 (class 0 OID 0)
-- Dependencies: 283
-- Name: vocation_idvocation_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('vocation_idvocation_seq', 1, false);


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


--
-- TOC entry 2800 (class 0 OID 0)
-- Dependencies: 7
-- Name: public; Type: ACL; Schema: -; Owner: postgres
--

REVOKE ALL ON SCHEMA public FROM PUBLIC;
REVOKE ALL ON SCHEMA public FROM postgres;
GRANT ALL ON SCHEMA public TO postgres;
GRANT ALL ON SCHEMA public TO PUBLIC;


-- Completed on 2018-11-28 11:33:57

--
-- PostgreSQL database dump complete
--

