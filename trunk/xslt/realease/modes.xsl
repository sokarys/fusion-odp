<?xml version="1.0" encoding="utf-8"?>
<xsl:stylesheet version="1.0"
		xmlns:xsl="http://www.w3.org/1999/XSL/Transform"
		>

  <xsl:template match="/">
    <out>
      <resume>
	<xsl:apply-templates mode="count"/>
      </resume>
      <content>
	<xsl:apply-templates mode="copy"/>
      </content>
    </out>
  </xsl:template>

  <!-- compte les fils de list -->

  <xsl:template match="list" mode="count">
    Il y a <xsl:value-of select="count(doc)"/> documents
  </xsl:template>


  <!-- copie les fils de list -->

  <xsl:template match="list" mode="copy">
    <xsl:copy>
      <xsl:apply-templates mode="copy"/>
    </xsl:copy>
  </xsl:template>

  <xsl:template match="doc" mode="copy">
    <xsl:copy/>
  </xsl:template>
</xsl:stylesheet>