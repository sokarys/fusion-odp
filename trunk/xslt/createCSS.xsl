
<xsl:stylesheet version="1.0" xmlns:xsl="http://www.w3.org/1999/XSL/Transform"   xmlns:office="urn:oasis:names:tc:opendocument:xmlns:office:1.0" xmlns:style="urn:oasis:names:tc:opendocument:xmlns:style:1.0" xmlns:text="urn:oasis:names:tc:opendocument:xmlns:text:1.0" xmlns:table="urn:oasis:names:tc:opendocument:xmlns:table:1.0" xmlns:draw="urn:oasis:names:tc:opendocument:xmlns:drawing:1.0" xmlns:fo="urn:oasis:names:tc:opendocument:xmlns:xsl-fo-compatible:1.0" xmlns:xlink="http://www.w3.org/1999/xlink" xmlns:dc="http://purl.org/dc/elements/1.1/" xmlns:meta="urn:oasis:names:tc:opendocument:xmlns:meta:1.0" xmlns:number="urn:oasis:names:tc:opendocument:xmlns:datastyle:1.0" xmlns:presentation="urn:oasis:names:tc:opendocument:xmlns:presentation:1.0" xmlns:svg="urn:oasis:names:tc:opendocument:xmlns:svg-compatible:1.0" xmlns:chart="urn:oasis:names:tc:opendocument:xmlns:chart:1.0" xmlns:dr3d="urn:oasis:names:tc:opendocument:xmlns:dr3d:1.0" xmlns:math="http://www.w3.org/1998/Math/MathML" xmlns:form="urn:oasis:names:tc:opendocument:xmlns:form:1.0" xmlns:script="urn:oasis:names:tc:opendocument:xmlns:script:1.0" xmlns:ooo="http://openoffice.org/2004/office" xmlns:ooow="http://openoffice.org/2004/writer" xmlns:oooc="http://openoffice.org/2004/calc" xmlns:dom="http://www.w3.org/2001/xml-events" xmlns:xforms="http://www.w3.org/2002/xforms" xmlns:xsd="http://www.w3.org/2001/XMLSchema" xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance" xmlns:smil="urn:oasis:names:tc:opendocument:xmlns:smil-compatible:1.0" xmlns:anim="urn:oasis:names:tc:opendocument:xmlns:animation:1.0" xmlns:rpt="http://openoffice.org/2005/report" xmlns:of="urn:oasis:names:tc:opendocument:xmlns:of:1.2" xmlns:xhtml="http://www.w3.org/1999/xhtml" xmlns:grddl="http://www.w3.org/2003/g/data-view#" xmlns:officeooo="http://openoffice.org/2009/office" xmlns:tableooo="http://openoffice.org/2009/table" xmlns:field="urn:openoffice:names:experimental:ooo-ms-interop:xmlns:field:1.0" xmlns:formx="urn:openoffice:names:experimental:ooxml-odf-interop:xmlns:form:1.0" office:version="1.2" grddl:transformation="http://docs.oasis-open.org/office/1.2/xslt/odf2rdf.xsl">

    <xsl:output method="html" indent="yes"/>


    <xsl:template match="style:style" >
        <xsl:if test="@style:name='Standard-title'">
	h1 {
            <xsl:apply-templates select="node()" mode="style"/>
        }
        </xsl:if>
        <xsl:if test="@style:name='Standard-subtitle'">
        h2 {
            <xsl:apply-templates select="node()" mode="style"/>
        }
        </xsl:if>
        
        <xsl:if test="@style:name='Standard-outline1'">
	ul {
            <xsl:apply-templates select="node()" mode="style"/>
	}
        </xsl:if>
    </xsl:template>

    <xsl:template match="style:style/style:graphic-properties" mode="style">
        <xsl:if test="@draw:fill-color">
                background-color:<xsl:value-of select="@draw:fill-color" />;
        </xsl:if>
    </xsl:template>

    <xsl:template match="style:style/style:paragraph-properties" mode="style">
        <xsl:if test="@fo:text-align">
                text-align:<xsl:value-of select="@fo:text-align" />;
        </xsl:if>
        <xsl:if test="@fo:margin-left">
                margin-left:<xsl:value-of select="@fo:margin-left" />;
        </xsl:if>
        <xsl:if test="@fo:margin-right">
                margin-right:<xsl:value-of select="@fo:margin-right" />;
        </xsl:if>
        <xsl:if test="@fo:margin-top">
                margin-top:<xsl:value-of select="@fo:margin-top" />;
        </xsl:if>
        <xsl:if test="@fo:margin-bottom">
                margin-bottom:<xsl:value-of select="@fo:margin-bottom" />;
        </xsl:if>
    </xsl:template>

    <xsl:template match="style:style/style:text-properties" mode="style">
            <xsl:if test="@fo:color">
                color:<xsl:value-of select="@fo:color" />;
            </xsl:if>
            <xsl:if test="@fo:font-style">
                font-style:<xsl:value-of select="@fo:font-style" />;
            </xsl:if>
            <xsl:if test="@fo:font-weight">
                font-weight:<xsl:value-of select="@fo:font-weight" />;
            </xsl:if>
            <xsl:if test="@style:text-underline-style">
                text-decoration:<xsl:value-of select="@style:text-underline-style" />;
            </xsl:if>
    </xsl:template>

   <xsl:template  match="node()|@*" mode="style">
       <xsl:apply-templates select="node()|@*"/>
   </xsl:template>

   <xsl:template  match="node()|@*">
       <xsl:apply-templates select="node()|@*"/>
   </xsl:template>
</xsl:stylesheet>
