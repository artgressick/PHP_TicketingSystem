<?xml version="1.0" encoding="utf-8"?>
<xsl:stylesheet
	xmlns:svg="http://www.w3.org/2000/svg"
	version="1.0"
	xmlns:xsl="http://www.w3.org/1999/XSL/Transform"
	xmlns:exsl="http://exslt.org/common"
	extension-element-prefixes="exsl"
>

<xsl:import href="code128.xsl"/>

<xsl:param name="barcode_value" select="'NO_VALUE'"/>
<xsl:param name="barcode_string" select="$barcode_value"/>
<xsl:param name="fullname" select="'Name not available'"/>
<xsl:param name="company" select="'Company not available'"/>
<xsl:param name="type" select="'Type not available'"/>
<xsl:param name="fontpath" select="'/Library/Tomcat/webapps/pdfrenderservice/WEB-INF/fonts/'"/>

<xsl:output method="xml" version="1.0" encoding="utf-8" indent="no"/>

<!-- This is used for the muenchian grouping to find the first occurrence of each font name. -->
<xsl:key name="fontnames" match="//svg:text" use="@font-family"/>

<!-- The stylesheet is based on this identity transform. It copies the input to the output unchanged
     and we use additional, more specific templates to manipulate some elements of the input document. -->

<xsl:template match="@*|node()">
	<xsl:copy>
		<xsl:apply-templates select="@*|node()"/>
	</xsl:copy>
</xsl:template>


<!-- We insert an additional defs section at the top of the SVG document below the root node.
     It contains the SVG fonts. -->
<xsl:template match="/svg:svg">
	<xsl:copy>
		<xsl:copy-of select="@*"/>
		<svg:defs>
		<xsl:comment>start embedded fonts</xsl:comment>
		<xsl:apply-templates select='//svg:text[generate-id() = generate-id(key("fontnames", @font-family))]' mode="insert-fonts"/>
		<xsl:comment>end embedded fonts</xsl:comment>
		</svg:defs>
		<xsl:apply-templates select="node()"/>
	</xsl:copy>
</xsl:template>



<xsl:template match='svg:text' mode="insert-fonts">
<xsl:variable name="fontname" select='substring(@font-family, 2, string-length(@font-family) - 2)'/>
<xsl:variable name="fullfontpath" select="concat($fontpath, '/', $fontname, '.svg')"/>
<xsl:comment>start embedded font family <xsl:value-of select="$fullfontpath"/></xsl:comment>
<xsl:apply-templates select="document($fullfontpath)/svg:svg/svg:defs/svg:font" mode="copy-font"/>
<xsl:comment>end embedded font family <xsl:value-of select="$fullfontpath"/></xsl:comment>
</xsl:template>

<xsl:template match="@*|node()" mode="copy-font">
	<xsl:copy>
		<xsl:apply-templates select="@*|node()" mode="copy-font"/>
	</xsl:copy>
</xsl:template>
<xsl:template match="svg:hkern" mode="copy-font"/>




<xsl:template match="svg:text[svg:tspan[normalize-space(.) = '_barcode_']]">

	<xsl:variable name="barcode.fragment">
		<xsl:call-template name="barcode-code128">
			<xsl:with-param name="value" select="$barcode_value"/>
			<xsl:with-param name="string" select="$barcode_string"/>
			<xsl:with-param name="module" select="'0.011in'"/>
		</xsl:call-template>
	</xsl:variable>
	<xsl:variable name="barcode" select="exsl:node-set($barcode.fragment)" />
	
	<xsl:comment>begin barcode</xsl:comment>
	<svg:g>
		<xsl:copy-of select="@transform"/>
		<svg:svg>
			<xsl:copy-of select="$barcode/svg:svg/@*"/>
			<xsl:copy-of select="$barcode/svg:svg/node()"/>
		</svg:svg>
	</svg:g>
	<xsl:comment>end barcode</xsl:comment>

</xsl:template>


<xsl:template match="svg:text[svg:tspan[normalize-space(.) = '_fullname_']]">
	<xsl:copy><xsl:copy-of select="@*"/><xsl:value-of select="$fullname"/></xsl:copy>
</xsl:template>

<xsl:template match="svg:text[svg:tspan[normalize-space(.) = '_type_']]">
	<xsl:copy><xsl:copy-of select="@*"/><xsl:value-of select="$type"/></xsl:copy>
</xsl:template>

<xsl:template match="svg:text[svg:tspan[normalize-space(.) = '_company_']]">
	<xsl:copy><xsl:copy-of select="@*"/><xsl:value-of select="$company"/></xsl:copy>
</xsl:template>





</xsl:stylesheet>

