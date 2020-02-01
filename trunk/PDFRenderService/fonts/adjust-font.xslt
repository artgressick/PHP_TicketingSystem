<?xml version="1.0" encoding="utf-8"?>

<xsl:stylesheet version="1.0" xmlns:xsl="http://www.w3.org/1999/XSL/Transform" xmlns:svg="http://www.w3.org/2000/svg">

<xsl:output method="xml" version="1.0" encoding="utf-8" indent="yes"/>

<xsl:template match="@*|node()">
	<xsl:copy>
		<xsl:apply-templates select="@*|node()"/>
	</xsl:copy>
</xsl:template>

<xsl:template match="@font-family">
	<xsl:attribute name="font-family"><xsl:value-of select="ancestor::svg:font/@id"/></xsl:attribute>
</xsl:template>

</xsl:stylesheet>