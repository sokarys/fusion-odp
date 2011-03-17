<xsl:stylesheet version="1.0" xmlns:xsl="http://www.w3.org/1999/XSL/Transform">

	<xsl:output method="xml" indent="yes"/>

        <!--Structure d'un document-->
        <xsl:template match="list">
            <document>
                <automatic-styles>
                      <xsl:apply-templates select="document(concat('tmp/','model','/content.xml'))" mode="modelStyle"/>
                      <xsl:apply-templates mode="style"/>
                </automatic-styles>
                <body>
                    <presentation>
                        <xsl:apply-templates mode="page"/>
                    </presentation>
                </body>
            </document>
        </xsl:template>

	<xsl:template match="list/doc" mode="page">
            <xsl:apply-templates  select="document(concat('tmp/',@src,'/content.xml'))/document/body/presentation/page">
                <xsl:with-param name="nomFile"><xsl:value-of select="@src"/> </xsl:with-param>
            </xsl:apply-templates>
	</xsl:template>

        <xsl:template match="list/doc" mode="style">
            <xsl:apply-templates  select="document(concat('tmp/',@src,'/content.xml'))/document/style" mode="style">
                <xsl:with-param name="nomFile"><xsl:value-of select="@src"/> </xsl:with-param>
            </xsl:apply-templates>
	</xsl:template>

<!--        <xsl:template match="list/doc" mode="modelStyle">
            <xsl:apply-templates  select="document(concat('tmp/','model','/content.xml'))/document/style" mode="modelStyle"/>
	</xsl:template>-->

	<xsl:template match="page">
             <xsl:param name="nomFile"/>
		<xsl:copy>
			<xsl:copy-of select="@*"/>
                         <xsl:if test="@name">
                        <xsl:attribute name="name">
                            <xsl:text> pages_<xsl:value-of select="position()"/><xsl:value-of select="$nomFile"/> </xsl:text>
                        </xsl:attribute>
                        </xsl:if>
			<xsl:copy-of select=".//*"/>
		</xsl:copy>
	</xsl:template>
        
        <xsl:template match="style" mode="style">
             <xsl:param name="nomFile"/>
             <xsl:copy>
			<xsl:copy-of select="@*"/>
                        <xsl:if test="@name">
                        <xsl:attribute name="name">
                            <xsl:text>style_<xsl:value-of select="position()"/><xsl:value-of select="$nomFile"/> </xsl:text>
                        </xsl:attribute>
                        </xsl:if>
			<xsl:copy-of select=".//*"/>
		</xsl:copy>
	</xsl:template>
        
        <xsl:template match="style" mode="modelStyle">
             <xsl:param name="nomFile"/>
             <xsl:copy>
			<xsl:copy-of select="@*"/>
			<xsl:copy-of select=".//*"/>
		</xsl:copy>
	</xsl:template>
        

</xsl:stylesheet>