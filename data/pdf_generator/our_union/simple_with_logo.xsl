<xsl:stylesheet 
	version="1.0"
	xmlns:xsl="http://www.w3.org/1999/XSL/Transform"
    xmlns:fo="http://www.w3.org/1999/XSL/Format"
>

    <xsl:template match="our_union">
        <fo:block>
            <xsl:apply-templates select="logo"/>
            <fo:block font-size="8pt">
                <xsl:apply-templates select="name/p"/>
            </fo:block>
        </fo:block>
    </xsl:template>
    
</xsl:stylesheet>
