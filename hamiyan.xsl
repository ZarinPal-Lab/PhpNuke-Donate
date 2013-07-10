<?xml version="1.0" encoding="UTF-8"?>
<xsl:stylesheet version="2.0" xmlns:html="http://www.w3.org/TR/REC-html40" xmlns:sitemap="http://www.sitemaps.org/schemas/sitemap/0.9" xmlns:xsl="http://www.w3.org/1999/XSL/Transform">
	<xsl:output method="html" version="1.0" encoding="UTF-8" indent="yes"/>
	<xsl:template match="/">
		<html xmlns="http://www.w3.org/1999/xhtml">
			<head>
				<title>لیست حامیان سایت</title>
				<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
				<link rel="stylesheet" type="text/css" href="themes/css/hemayat2.css" />
			</head>
			<body>
				<div id="content" align="center">
					<table cellpadding="5" width="95%">
						<tr style="text-align:center;background:#fff; border:1px #000 solaid;">
							<th width="5%">شناسه</th>
							<th width="15%">نام کاربری</th>
							<th width="15%">مبلغ حمایت</th>
							<th width="25%">تاریخ و زمان</th>
							<th width="40%">نوع حمایت</th>
						</tr>
						<xsl:variable name="lower" select="'abcdefghijklmnopqrstuvwxyz'"/>
						<xsl:variable name="upper" select="'ABCDEFGHIJKLMNOPQRSTUVWXYZ'"/>
						<xsl:for-each select="sitemap:urlset/sitemap:url">
							<tr>
								<xsl:if test="position() mod 2 != 1">
									<xsl:attribute  name="class"></xsl:attribute>
								</xsl:if>
								<td width="5%">
									<xsl:value-of select="sitemap:nom"/>
								</td>
								<td width="15%">
									<xsl:variable name="itemURL">
										<xsl:value-of select="sitemap:loc"/>
									</xsl:variable>
									<xsl:value-of select="sitemap:loc"/>
								</td>

								<td width="15%">
									<xsl:value-of select="sitemap:priority"/> 
								</td>
								<td width="25%">
									<xsl:value-of select="sitemap:lastmod"/>
								</td>
								<td width="40%">
									<xsl:value-of select="sitemap:changefreq"/>
								</td>

							</tr>
						</xsl:for-each>
					</table>
				</div><br /><center><b>Powered By Hamed.Ramzi <a href="http://aryan-translators.ir" target="_blank">Aryan-Translators.ir</a></b></center><br /><center><a onclick="window.open ('https://www.zarinpal.com/webservice/Trustlogo/aryan-translators.ir',null,'width=656, height=500, scrollbars=no, resizable=no');" href="javascript:;;"><img src="http://www.zarinpal.com/img/merchant/merchant-1.png" border="0" /></a></center><br /><br />
			</body>
		</html>
	</xsl:template>
</xsl:stylesheet>