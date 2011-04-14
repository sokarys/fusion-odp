
<xsl:stylesheet version="1.0" xmlns:xsl="http://www.w3.org/1999/XSL/Transform"   xmlns:office="urn:oasis:names:tc:opendocument:xmlns:office:1.0" xmlns:style="urn:oasis:names:tc:opendocument:xmlns:style:1.0" xmlns:text="urn:oasis:names:tc:opendocument:xmlns:text:1.0" xmlns:table="urn:oasis:names:tc:opendocument:xmlns:table:1.0" xmlns:draw="urn:oasis:names:tc:opendocument:xmlns:drawing:1.0" xmlns:fo="urn:oasis:names:tc:opendocument:xmlns:xsl-fo-compatible:1.0" xmlns:xlink="http://www.w3.org/1999/xlink" xmlns:dc="http://purl.org/dc/elements/1.1/" xmlns:meta="urn:oasis:names:tc:opendocument:xmlns:meta:1.0" xmlns:number="urn:oasis:names:tc:opendocument:xmlns:datastyle:1.0" xmlns:presentation="urn:oasis:names:tc:opendocument:xmlns:presentation:1.0" xmlns:svg="urn:oasis:names:tc:opendocument:xmlns:svg-compatible:1.0" xmlns:chart="urn:oasis:names:tc:opendocument:xmlns:chart:1.0" xmlns:dr3d="urn:oasis:names:tc:opendocument:xmlns:dr3d:1.0" xmlns:math="http://www.w3.org/1998/Math/MathML" xmlns:form="urn:oasis:names:tc:opendocument:xmlns:form:1.0" xmlns:script="urn:oasis:names:tc:opendocument:xmlns:script:1.0" xmlns:ooo="http://openoffice.org/2004/office" xmlns:ooow="http://openoffice.org/2004/writer" xmlns:oooc="http://openoffice.org/2004/calc" xmlns:dom="http://www.w3.org/2001/xml-events" xmlns:xforms="http://www.w3.org/2002/xforms" xmlns:xsd="http://www.w3.org/2001/XMLSchema" xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance" xmlns:smil="urn:oasis:names:tc:opendocument:xmlns:smil-compatible:1.0" xmlns:anim="urn:oasis:names:tc:opendocument:xmlns:animation:1.0" xmlns:rpt="http://openoffice.org/2005/report" xmlns:of="urn:oasis:names:tc:opendocument:xmlns:of:1.2" xmlns:xhtml="http://www.w3.org/1999/xhtml" xmlns:grddl="http://www.w3.org/2003/g/data-view#" xmlns:officeooo="http://openoffice.org/2009/office" xmlns:tableooo="http://openoffice.org/2009/table" xmlns:field="urn:openoffice:names:experimental:ooo-ms-interop:xmlns:field:1.0" xmlns:formx="urn:openoffice:names:experimental:ooxml-odf-interop:xmlns:form:1.0" office:version="1.2" grddl:transformation="http://docs.oasis-open.org/office/1.2/xslt/odf2rdf.xsl">

    <xsl:output method="html" indent="yes"/>

    <xsl:template match="office:document-content">
        <html lang="en">
            <head>
                <meta charset="utf-8" />
                <title> HTML Timing :: Slideshow Engine </title>
                <link rel="stylesheet" type="text/css" href="./../../timesheets/demo/style/layout.css"/>
                <link rel="stylesheet" type="text/css" href="./../../timesheets/demo/style/transitions.css"/>
                <link rel="stylesheet" type="text/css" href="./../../timesheets/demo/style/slideshow.css"/>
                <script type="text/javascript" src="./../../timesheets/timesheets.js"></script>
                <script type="text/javascript" src="./../../timesheets/timesheets-navigation.js"></script>
                <style>
                    <xsl:apply-templates mode="style"/>
                </style>
            </head>
            <body class="carousel">
                <div id="demo">
                    <div id="slideshow"
                     data-timecontainer = "seq"
                     data-timeaction    = "intrinsic"
                     data-navigation    = "arrows; hash; scroll;"
                     data-first         = "first.click"
                     data-prev          = "prev.click"
                     data-next          = "next.click"
                     data-last          = "last.click">

                        <xsl:apply-templates select="/office:document-content/office:body/office:presentation/draw:page"  mode="content"/>
            
                        <p class="menu" data-timeaction="none">
                            <button id="first" title="first slide">       |«     </button>
                            <button id="prev"  title="previous slide"> &lt; prev </button>
                            <button id="next"  title="next slide">     next &gt; </button>
                            <button id="last"  title="last slide">         »|    </button>
                        </p>

                    </div>
                </div>

                <p id="transitionSelector">
                    <strong>CSS transition</strong>:
                    <button class="none"
                  onclick="document.body.className='none';">none
                    </button> |
                    <button class="crossfade"
                  onclick="document.body.className='crossfade';">cross-fade
                    </button> |
                    <button class="fadethrough"
                  onclick="document.body.className='fadethrough';">fade-through
                    </button> |
                    <button class="carousel"
                  onclick="document.body.className='carousel';">carousel
                    </button> |
                    <button class="slide"
                  onclick="document.body.className='slide';">slide-in
                    </button> |
                    <button class="toss"
                  onclick="document.body.className='toss';">toss
                    </button>
                </p>
            </body>
        </html>

    </xsl:template>
    
    <xsl:template match="/office:document-content/office:body/office:presentation/draw:page"  mode="content">
        <div smil:timeContainer="par" smil:dur="12s">
            <xsl:attribute name="id">slide<xsl:value-of select="position() div 2"/></xsl:attribute>
            <xsl:apply-templates select="node()" mode="content"/>
        </div>
        <xsl:message>Testt 1</xsl:message>
    </xsl:template>

    <xsl:template match="text:p"  mode="content">
        <p>
            <xsl:if test="count(text:span) >= 1">
                <xsl:apply-templates select="node()" mode="content"/>
            </xsl:if>
            <xsl:if test="count(text:span) = 0">
                <xsl:apply-templates select="."/>
            </xsl:if>
        </p>
    </xsl:template>

    <xsl:template match="text:list"  mode="content">
        <ul smil:timeContainer="par">
           <xsl:apply-templates select="node()"  mode="content"/>
        </ul>
    </xsl:template>

    <xsl:template match="text:list-item"  mode="content">
        <li>
            <xsl:attribute name="smil:begin">0:0<xsl:value-of select="position()"/></xsl:attribute>
            <xsl:apply-templates select="node()"  mode="content"/>
        </li>
    </xsl:template>

    <xsl:template match="text:list/text:list-item/text:p"  mode="content">
        <xsl:if test="count(text:span) >= 1">
        <xsl:apply-templates select="node()" mode="content"/>
        </xsl:if>
        <xsl:if test="count(text:span) = 0">
        <xsl:apply-templates select="."/>
        </xsl:if>
    </xsl:template>

    
    <xsl:template match="text:span"  mode="content">
            <xsl:attribute name="class"><xsl:value-of select="@text:style-name"/></xsl:attribute>
            <xsl:value-of select="node()"  mode="content"/>
    </xsl:template>


    <xsl:template match="draw:frame"  mode="content">
            <xsl:choose>
            <xsl:when test="@presentation:class = 'title'">
                <h2><xsl:apply-templates select="draw:text-box/text:p"  mode="content"/></h2>
            </xsl:when>
            <xsl:when test="@presentation:class != 'title'">
                <xsl:apply-templates select="node()"  mode="content"/>
            </xsl:when>
            </xsl:choose>
    </xsl:template>

    <xsl:template match="draw:image" mode="content">
        <img>
        <xsl:attribute name="src">./document/<xsl:value-of select="@xlink:href"/></xsl:attribute>
        </img>
    </xsl:template>
    
   <xsl:template match="style:style" mode="style">
        .<xsl:value-of select="@style:name"/>{
            <xsl:if test="style:text-properties/@fo:color">
                color:<xsl:value-of select="style:text-properties/@fo:color" />;
            </xsl:if>
            <xsl:if test="style:text-properties/@fo:font-style">
                font-style:<xsl:value-of select="style:text-properties/@fo:font-style" />;
            </xsl:if>
            <xsl:if test="style:text-properties/@fo:font-weight">
                font-weight:<xsl:value-of select="style:text-properties/@fo:font-weight" />;
            </xsl:if>
            <xsl:if test="style:text-properties/@style:text-underline-style">
                    text-decoration:underline;
            </xsl:if>
        }
        
    </xsl:template>

   <xsl:template  match="node()|@*" mode="style">
       <xsl:apply-templates select="node()|@*"  mode="style"/>
   </xsl:template>

   <xsl:template  match="node()|@*" mode="content">
       <xsl:apply-templates select="node()|@*"  mode="content"/>
   </xsl:template>
</xsl:stylesheet>
