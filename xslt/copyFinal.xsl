<xsl:stylesheet version="1.0" xmlns:xsl="http://www.w3.org/1999/XSL/Transform"   xmlns:office="urn:oasis:names:tc:opendocument:xmlns:office:1.0" xmlns:style="urn:oasis:names:tc:opendocument:xmlns:style:1.0" xmlns:text="urn:oasis:names:tc:opendocument:xmlns:text:1.0" xmlns:table="urn:oasis:names:tc:opendocument:xmlns:table:1.0" xmlns:draw="urn:oasis:names:tc:opendocument:xmlns:drawing:1.0" xmlns:fo="urn:oasis:names:tc:opendocument:xmlns:xsl-fo-compatible:1.0" xmlns:xlink="http://www.w3.org/1999/xlink" xmlns:dc="http://purl.org/dc/elements/1.1/" xmlns:meta="urn:oasis:names:tc:opendocument:xmlns:meta:1.0" xmlns:number="urn:oasis:names:tc:opendocument:xmlns:datastyle:1.0" xmlns:presentation="urn:oasis:names:tc:opendocument:xmlns:presentation:1.0" xmlns:svg="urn:oasis:names:tc:opendocument:xmlns:svg-compatible:1.0" xmlns:chart="urn:oasis:names:tc:opendocument:xmlns:chart:1.0" xmlns:dr3d="urn:oasis:names:tc:opendocument:xmlns:dr3d:1.0" xmlns:math="http://www.w3.org/1998/Math/MathML" xmlns:form="urn:oasis:names:tc:opendocument:xmlns:form:1.0" xmlns:script="urn:oasis:names:tc:opendocument:xmlns:script:1.0" xmlns:ooo="http://openoffice.org/2004/office" xmlns:ooow="http://openoffice.org/2004/writer" xmlns:oooc="http://openoffice.org/2004/calc" xmlns:dom="http://www.w3.org/2001/xml-events" xmlns:xforms="http://www.w3.org/2002/xforms" xmlns:xsd="http://www.w3.org/2001/XMLSchema" xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance" xmlns:smil="urn:oasis:names:tc:opendocument:xmlns:smil-compatible:1.0" xmlns:anim="urn:oasis:names:tc:opendocument:xmlns:animation:1.0" xmlns:rpt="http://openoffice.org/2005/report" xmlns:of="urn:oasis:names:tc:opendocument:xmlns:of:1.2" xmlns:xhtml="http://www.w3.org/1999/xhtml" xmlns:grddl="http://www.w3.org/2003/g/data-view#" xmlns:officeooo="http://openoffice.org/2009/office" xmlns:tableooo="http://openoffice.org/2009/table" xmlns:field="urn:openoffice:names:experimental:ooo-ms-interop:xmlns:field:1.0" xmlns:formx="urn:openoffice:names:experimental:ooxml-odf-interop:xmlns:form:1.0" office:version="1.2" grddl:transformation="http://docs.oasis-open.org/office/1.2/xslt/odf2rdf.xsl">

	<xsl:output method="xml" indent="yes"/>
        <!--Structure d'un document, parcours de la liste pour créer le nouveau document : content.xml-->
        <xsl:template match="list">
            <office:document-content xmlns:office="urn:oasis:names:tc:opendocument:xmlns:office:1.0" xmlns:style="urn:oasis:names:tc:opendocument:xmlns:style:1.0" xmlns:text="urn:oasis:names:tc:opendocument:xmlns:text:1.0" xmlns:table="urn:oasis:names:tc:opendocument:xmlns:table:1.0" xmlns:draw="urn:oasis:names:tc:opendocument:xmlns:drawing:1.0" xmlns:fo="urn:oasis:names:tc:opendocument:xmlns:xsl-fo-compatible:1.0" xmlns:xlink="http://www.w3.org/1999/xlink" xmlns:dc="http://purl.org/dc/elements/1.1/" xmlns:meta="urn:oasis:names:tc:opendocument:xmlns:meta:1.0" xmlns:number="urn:oasis:names:tc:opendocument:xmlns:datastyle:1.0" xmlns:presentation="urn:oasis:names:tc:opendocument:xmlns:presentation:1.0" xmlns:svg="urn:oasis:names:tc:opendocument:xmlns:svg-compatible:1.0" xmlns:chart="urn:oasis:names:tc:opendocument:xmlns:chart:1.0" xmlns:dr3d="urn:oasis:names:tc:opendocument:xmlns:dr3d:1.0" xmlns:math="http://www.w3.org/1998/Math/MathML" xmlns:form="urn:oasis:names:tc:opendocument:xmlns:form:1.0" xmlns:script="urn:oasis:names:tc:opendocument:xmlns:script:1.0" xmlns:ooo="http://openoffice.org/2004/office" xmlns:ooow="http://openoffice.org/2004/writer" xmlns:oooc="http://openoffice.org/2004/calc" xmlns:dom="http://www.w3.org/2001/xml-events" xmlns:xforms="http://www.w3.org/2002/xforms" xmlns:xsd="http://www.w3.org/2001/XMLSchema" xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance" xmlns:smil="urn:oasis:names:tc:opendocument:xmlns:smil-compatible:1.0" xmlns:anim="urn:oasis:names:tc:opendocument:xmlns:animation:1.0" xmlns:rpt="http://openoffice.org/2005/report" xmlns:of="urn:oasis:names:tc:opendocument:xmlns:of:1.2" xmlns:xhtml="http://www.w3.org/1999/xhtml" xmlns:grddl="http://www.w3.org/2003/g/data-view#" xmlns:officeooo="http://openoffice.org/2009/office" xmlns:tableooo="http://openoffice.org/2009/table" xmlns:field="urn:openoffice:names:experimental:ooo-ms-interop:xmlns:field:1.0" xmlns:formx="urn:openoffice:names:experimental:ooxml-odf-interop:xmlns:form:1.0" office:version="1.2" grddl:transformation="http://docs.oasis-open.org/office/1.2/xslt/odf2rdf.xsl">
                <office:automatic-styles>
                      <xsl:apply-templates select="document(concat('tmp/','model','/content.xml'))/office:document-content/office:automatic-styles" mode="modelStyle"/>
                      <xsl:apply-templates mode="style"/>
                </office:automatic-styles>
                <office:body>
                    <office:presentation>
                        <xsl:apply-templates mode="page"/>
                    </office:presentation>
                </office:body>
            </office:document-content>
        </xsl:template>

        <!--     parcours la liste de document pour y copier les pages   -->
	<xsl:template match="list/doc" mode="page">
            <xsl:apply-templates  select="document(concat('tmp/',@src,'/content.xml'))/office:document-content/office:body/office:presentation/draw:page">
                <xsl:with-param name="nomFile"><xsl:value-of select="@src"/> </xsl:with-param>
            </xsl:apply-templates>
	</xsl:template>


        <!--     parcours la liste de document pour y copier les Styles   -->
        <xsl:template match="list/doc" mode="style">
            <xsl:apply-templates  select="document(concat('tmp/',@src,'/content.xml'))/office:document-content/office:automatic-styles" mode="style">
                <xsl:with-param name="nomFile"><xsl:value-of select="@src"/> </xsl:with-param>
            </xsl:apply-templates>
	</xsl:template>

<!--        <xsl:template match="list/doc" mode="modelStyle">
            <xsl:apply-templates  select="document(concat('tmp/','model','/content.xml'))/document/style" mode="modelStyle"/>
	</xsl:template>-->

    <!--Permet à xsl, de copier le contenu d'une page en modifiant des attribut-->
	<xsl:template match="draw:page">
             <xsl:param name="nomFile"/>
		<xsl:copy>
			<xsl:copy-of select="@*"/>
                        <xsl:if test="@draw:name">
                        <xsl:attribute name="draw:name">
                            <xsl:value-of select="$nomFile"/><xsl:value-of select="@draw:name"/>
                        </xsl:attribute>
                        </xsl:if>
			<xsl:apply-templates select="node()" mode="page">
                             <xsl:with-param name="nomFile"><xsl:value-of select="$nomFile"/> </xsl:with-param>
                        </xsl:apply-templates>
		</xsl:copy>
	</xsl:template>

        <!--Permet à xsl, de copier le contenu d'un style d'un content.xml en modifiant des attribut-->
        <xsl:template match="office:automatic-styles" mode="style">
            <xsl:param name="nomFile"/>
<!--<xsl:message><xsl:value-of select="current()/style:style/@style:name"/></xsl:message>-->
          
                <xsl:apply-templates select="@*" mode="style">
                    <xsl:with-param name="nomFile"><xsl:value-of select="$nomFile"/> </xsl:with-param>
                </xsl:apply-templates>
                <xsl:apply-templates select="node()" mode="style">
                    <xsl:with-param name="nomFile"><xsl:value-of select="$nomFile"/> </xsl:with-param>
                </xsl:apply-templates>
	</xsl:template>
        
        <xsl:template match="office:automatic-styles" mode="modelStyle">
            <xsl:copy-of select="node()"/>
	</xsl:template>

        <xsl:template match="style:style" mode="style" >
             <xsl:param name="nomFile"/>
<!--<xsl:message><xsl:value-of select="@style:name"/> != <xsl:value-of select="document(copyFinal.xml)/*"/></xsl:message>-->
<!--<xsl:if test="//node()/style:style[@style:name != curent/@style:name]">-->
             <xsl:copy>
			<xsl:copy-of select="@*"/>
                        <xsl:if test="@style:name">
                        <xsl:attribute name="style:name">
<!--<xsl:message><xsl:value-of select="$nomFile"/></xsl:message>-->
                            <xsl:value-of select="$nomFile"/><xsl:value-of select="@style:name"/>
                        </xsl:attribute>
                        </xsl:if>
			<xsl:copy-of select="node()"/>
		</xsl:copy>
<!--</xsl:if>-->
	</xsl:template>

         <xsl:template match="text:span" mode="page">
            <xsl:param name="nomFile"/>
           <xsl:message>sdfsdfsdfsdf<xsl:value-of select="$nomFile"/></xsl:message>
            <xsl:copy>
<!--                        <xsl:copy-of select="@*"/>-->
                        <xsl:if test="@text:style-name">
                        <xsl:attribute name="text:style-name">
                            <xsl:value-of select="$nomFile"/><xsl:value-of select="@text:style-name"/>
                        </xsl:attribute>
                        </xsl:if>
                        <xsl:copy-of select="node()"/>
            </xsl:copy>
         </xsl:template>

         <xsl:template match="node()|@*" mode="style">
             <xsl:param name="nomFile"/>
            <xsl:copy>
                <xsl:apply-templates select="node()|@*"  mode="style">
                     <xsl:with-param name="nomFile"><xsl:value-of select="$nomFile"/> </xsl:with-param>
                </xsl:apply-templates>
            </xsl:copy>
        </xsl:template>

       <xsl:template match="node()|@*" mode="modelStyle">
            <xsl:copy>
                <xsl:apply-templates select="node()|@*"  mode="modelStyle"/>
            </xsl:copy>
        </xsl:template>
        
        <xsl:template match="node()|@*" mode="page">
            <xsl:param name="nomFile"/>
            <xsl:copy>
                <xsl:apply-templates select="node()|@*"  mode="page">
                    <xsl:with-param name="nomFile"><xsl:value-of select="$nomFile"/> </xsl:with-param>
                </xsl:apply-templates>
            </xsl:copy>
        </xsl:template>
       

</xsl:stylesheet>
