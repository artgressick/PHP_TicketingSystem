#!/bin/sh

for i in `(cd ttf && ls *.ttf)`; do

	FONT=`echo $i | sed -e 's/.ttf//g'`
	java -jar batik-1.5.1/batik-ttf2svg.jar ttf/$FONT.ttf -id $FONT -l 0 -h 500 -o svg/$FONT.svg
	#-testcard
	perl -p -i -e 's!^.+<svg!<svg xmlns="http://www.w3.org/2000/svg"!' svg/$FONT.svg
	xsltproc --nonet adjust-font.xslt svg/$FONT.svg > out.svg
	mv out.svg svg/$FONT.svg
	echo $FONT

done
