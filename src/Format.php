<?php

namespace Mnvx\Lowrapper;

class Format
{
    // TextDocument
    const TEXT_BIB = 'bib';
    const TEXT_DOC = 'doc';
    const TEXT_DOC6 = 'doc6';
    const TEXT_DOC95 = 'doc95';
    const TEXT_DOCBOOK = 'docbook';
    const TEXT_DOCX = 'docx';
    const TEXT_DOCX7 = 'docx7';
    const TEXT_FODT = 'fodt';
    const TEXT_HTML = 'html';
    const TEXT_LATEX = 'latex';
    const TEXT_MEDIAWIKI = 'mediawiki';
    const TEXT_ODT = 'odt';
    const TEXT_OOXML = 'ooxml';
    const TEXT_OTT = 'ott';
    const TEXT_PDB = 'pdb';
    const TEXT_PDF = 'pdf';
    const TEXT_PSW = 'psw';
    const TEXT_RTF = 'rtf';
    const TEXT_SDW = 'sdw';
    const TEXT_SDW4 = 'sdw4';
    const TEXT_SDW3 = 'sdw3';
    const TEXT_STW = 'stw';
    const TEXT_SXW = 'sxw';
    const TEXT_TEXT = 'text';
    const TEXT_TXT = 'txt';
    const TEXT_UOT = 'uot';
    const TEXT_VOR = 'vor';
    const TEXT_VOR4 = 'vor4';
    const TEXT_VOR3 = 'vor3';
    const TEXT_WPS = 'wps';
    const TEXT_XHTML = 'xhtml';

    // WebDocument
    const WEB_ETEXT = 'etext';
    const WEB_HTML10 = 'html10';
    const WEB_HTML = 'html';
    const WEB_MEDIAWIKI = 'mediawiki';
    const WEB_PDF = 'pdf';
    const WEB_SDW3 = 'sdw3';
    const WEB_SDW4 = 'sdw4';
    const WEB_SDW = 'sdw';
    const WEB_TXT = 'txt';
    const WEB_TEXT10 = 'text10';
    const WEB_TEXT = 'text';
    const WEB_VOR4 = 'vor4';
    const WEB_VOR = 'vor';

    // Spreadsheet
    const SPREADSHEET_CSV = 'csv';
    const SPREADSHEET_DBF = 'dbf';
    const SPREADSHEET_DIF = 'dif';
    const SPREADSHEET_FODS = 'fods';
    const SPREADSHEET_HTML = 'html';
    const SPREADSHEET_ODS = 'ods';
    const SPREADSHEET_OOXML = 'ooxml';
    const SPREADSHEET_OTS = 'ots';
    const SPREADSHEET_PDF = 'pdf';
    const SPREADSHEET_PXL = 'pxl';
    const SPREADSHEET_SDC = 'sdc';
    const SPREADSHEET_SDC4 = 'sdc4';
    const SPREADSHEET_SDC3 = 'sdc3';
    const SPREADSHEET_SLK = 'slk';
    const SPREADSHEET_STC = 'stc';
    const SPREADSHEET_SXC = 'sxc';
    const SPREADSHEET_UOS = 'uos';
    const SPREADSHEET_VOR3 = 'vor3';
    const SPREADSHEET_VOR4 = 'vor4';
    const SPREADSHEET_VOR = 'vor';
    const SPREADSHEET_XHTML = 'xhtml';
    const SPREADSHEET_XLS = 'xls';
    const SPREADSHEET_XLS5 = 'xls5';
    const SPREADSHEET_XLS95 = 'xls95';
    const SPREADSHEET_XLT = 'xlt';
    const SPREADSHEET_XLT5 = 'xlt5';
    const SPREADSHEET_XLT95 = 'xlt95';
    const SPREADSHEET_XLSX = 'xlsx';

    // Graphics
    const GRAPHICS_BMP = 'bmp';
    const GRAPHICS_EMF = 'emf';
    const GRAPHICS_EPS = 'eps';
    const GRAPHICS_FODG = 'fodg';
    const GRAPHICS_GIF = 'gif';
    const GRAPHICS_HTML = 'html';
    const GRAPHICS_JPG = 'jpg';
    const GRAPHICS_MET = 'met';
    const GRAPHICS_ODD = 'odd';
    const GRAPHICS_OTG = 'otg';
    const GRAPHICS_PBM = 'pbm';
    const GRAPHICS_PCT = 'pct';
    const GRAPHICS_PDF = 'pdf';
    const GRAPHICS_PGM = 'pgm';
    const GRAPHICS_PNG = 'png';
    const GRAPHICS_PPM = 'ppm';
    const GRAPHICS_RAS = 'ras';
    const GRAPHICS_STD = 'std';
    const GRAPHICS_SVG = 'svg';
    const GRAPHICS_SVM = 'svm';
    const GRAPHICS_SWF = 'swf';
    const GRAPHICS_SXD = 'sxd';
    const GRAPHICS_SXD3 = 'sxd3';
    const GRAPHICS_SXD5 = 'sxd5';
    const GRAPHICS_SXW = 'sxw';
    const GRAPHICS_TIFF = 'tiff';
    const GRAPHICS_VOR = 'vor';
    const GRAPHICS_VOR3 = 'vor3';
    const GRAPHICS_WMF = 'wmf';
    const GRAPHICS_XHTML = 'xhtml';
    const GRAPHICS_XPM = 'xpm';

    // Presentation
    const PRESENTATION_BMP = 'bmp';
    const PRESENTATION_EMF = 'emf';
    const PRESENTATION_EPS = 'eps';
    const PRESENTATION_FODP = 'fodp';
    const PRESENTATION_GIF = 'gif';
    const PRESENTATION_HTML = 'html';
    const PRESENTATION_JPG = 'jpg';
    const PRESENTATION_MET = 'met';
    const PRESENTATION_ODG = 'odg';
    const PRESENTATION_ODP = 'odp';
    const PRESENTATION_OTP = 'otp';
    const PRESENTATION_PBM = 'pbm';
    const PRESENTATION_PCT = 'pct';
    const PRESENTATION_PDF = 'pdf';
    const PRESENTATION_PGM = 'pgm';
    const PRESENTATION_PNG = 'png';
    const PRESENTATION_POTM = 'potm';
    const PRESENTATION_POT = 'pot';
    const PRESENTATION_PPM = 'ppm';
    const PRESENTATION_PPTX = 'pptx';
    const PRESENTATION_PPS = 'pps';
    const PRESENTATION_PPT = 'ppt';
    const PRESENTATION_PWP = 'pwp';
    const PRESENTATION_RAS = 'ras';
    const PRESENTATION_SDA = 'sda';
    const PRESENTATION_SDD = 'sdd';
    const PRESENTATION_SDD3 = 'sdd3';
    const PRESENTATION_SDD4 = 'sdd4';
    const PRESENTATION_SXD = 'sxd';
    const PRESENTATION_STI = 'sti';
    const PRESENTATION_SVG = 'svg';
    const PRESENTATION_SVM = 'svm';
    const PRESENTATION_SWF = 'swf';
    const PRESENTATION_SXI = 'sxi';
    const PRESENTATION_TIFF = 'tiff';
    const PRESENTATION_UOP = 'uop';
    const PRESENTATION_VOR = 'vor';
    const PRESENTATION_VOR3 = 'vor3';
    const PRESENTATION_VOR4 = 'vor4';
    const PRESENTATION_VOR5 = 'vor5';
    const PRESENTATION_WMF = 'wmf';
    const PRESENTATION_XPM = 'xpm';


    /**
     * @var string[]
     */
    protected static $values = [
        // TextDocument
        self::TEXT_BIB,
        self::TEXT_DOC,
        self::TEXT_DOC6,
        self::TEXT_DOC95,
        self::TEXT_DOCBOOK,
        self::TEXT_DOCX,
        self::TEXT_DOCX7,
        self::TEXT_FODT,
        self::TEXT_HTML,
        self::TEXT_LATEX,
        self::TEXT_MEDIAWIKI,
        self::TEXT_ODT,
        self::TEXT_OOXML,
        self::TEXT_OTT,
        self::TEXT_PDB,
        self::TEXT_PDF,
        self::TEXT_PSW,
        self::TEXT_RTF,
        self::TEXT_SDW,
        self::TEXT_SDW4,
        self::TEXT_SDW3,
        self::TEXT_STW,
        self::TEXT_SXW,
        self::TEXT_TEXT,
        self::TEXT_TXT,
        self::TEXT_UOT,
        self::TEXT_VOR,
        self::TEXT_VOR4,
        self::TEXT_VOR3,
        self::TEXT_WPS,
        self::TEXT_XHTML,

        // WebDocument
        self::WEB_ETEXT,
        self::WEB_HTML10,
        self::WEB_HTML,
        self::WEB_MEDIAWIKI,
        self::WEB_PDF,
        self::WEB_SDW3,
        self::WEB_SDW4,
        self::WEB_SDW,
        self::WEB_TXT,
        self::WEB_TEXT10,
        self::WEB_TEXT,
        self::WEB_VOR4,
        self::WEB_VOR,

        // Spreadsheet
        self::SPREADSHEET_CSV,
        self::SPREADSHEET_DBF,
        self::SPREADSHEET_DIF,
        self::SPREADSHEET_FODS,
        self::SPREADSHEET_HTML,
        self::SPREADSHEET_ODS,
        self::SPREADSHEET_OOXML,
        self::SPREADSHEET_OTS,
        self::SPREADSHEET_PDF,
        self::SPREADSHEET_PXL,
        self::SPREADSHEET_SDC,
        self::SPREADSHEET_SDC4,
        self::SPREADSHEET_SDC3,
        self::SPREADSHEET_SLK,
        self::SPREADSHEET_STC,
        self::SPREADSHEET_SXC,
        self::SPREADSHEET_UOS,
        self::SPREADSHEET_VOR3,
        self::SPREADSHEET_VOR4,
        self::SPREADSHEET_VOR,
        self::SPREADSHEET_XHTML,
        self::SPREADSHEET_XLS,
        self::SPREADSHEET_XLS5,
        self::SPREADSHEET_XLS95,
        self::SPREADSHEET_XLT,
        self::SPREADSHEET_XLT5,
        self::SPREADSHEET_XLT95,
        self::SPREADSHEET_XLSX,

        // Graphics
        self::GRAPHICS_BMP,
        self::GRAPHICS_EMF,
        self::GRAPHICS_EPS,
        self::GRAPHICS_FODG,
        self::GRAPHICS_GIF,
        self::GRAPHICS_HTML,
        self::GRAPHICS_JPG,
        self::GRAPHICS_MET,
        self::GRAPHICS_ODD,
        self::GRAPHICS_OTG,
        self::GRAPHICS_PBM,
        self::GRAPHICS_PCT,
        self::GRAPHICS_PDF,
        self::GRAPHICS_PGM,
        self::GRAPHICS_PNG,
        self::GRAPHICS_PPM,
        self::GRAPHICS_RAS,
        self::GRAPHICS_STD,
        self::GRAPHICS_SVG,
        self::GRAPHICS_SVM,
        self::GRAPHICS_SWF,
        self::GRAPHICS_SXD,
        self::GRAPHICS_SXD3,
        self::GRAPHICS_SXD5,
        self::GRAPHICS_SXW,
        self::GRAPHICS_TIFF,
        self::GRAPHICS_VOR,
        self::GRAPHICS_VOR3,
        self::GRAPHICS_WMF,
        self::GRAPHICS_XHTML,
        self::GRAPHICS_XPM,

        // Presentation
        self::PRESENTATION_BMP,
        self::PRESENTATION_EMF,
        self::PRESENTATION_EPS,
        self::PRESENTATION_FODP,
        self::PRESENTATION_GIF,
        self::PRESENTATION_HTML,
        self::PRESENTATION_JPG,
        self::PRESENTATION_MET,
        self::PRESENTATION_ODG,
        self::PRESENTATION_ODP,
        self::PRESENTATION_OTP,
        self::PRESENTATION_PBM,
        self::PRESENTATION_PCT,
        self::PRESENTATION_PDF,
        self::PRESENTATION_PGM,
        self::PRESENTATION_PNG,
        self::PRESENTATION_POTM,
        self::PRESENTATION_POT,
        self::PRESENTATION_PPM,
        self::PRESENTATION_PPTX,
        self::PRESENTATION_PPS,
        self::PRESENTATION_PPT,
        self::PRESENTATION_PWP,
        self::PRESENTATION_RAS,
        self::PRESENTATION_SDA,
        self::PRESENTATION_SDD,
        self::PRESENTATION_SDD3,
        self::PRESENTATION_SDD4,
        self::PRESENTATION_SXD,
        self::PRESENTATION_STI,
        self::PRESENTATION_SVG,
        self::PRESENTATION_SVM,
        self::PRESENTATION_SWF,
        self::PRESENTATION_SXI,
        self::PRESENTATION_TIFF,
        self::PRESENTATION_UOP,
        self::PRESENTATION_VOR,
        self::PRESENTATION_VOR3,
        self::PRESENTATION_VOR4,
        self::PRESENTATION_VOR5,
        self::PRESENTATION_WMF,
        self::PRESENTATION_XPM,
    ];

    /**
     * List of available formats
     * @return string[]
     */
    public static function getAvailableValues()
    {
        return static::$values;
    }

}