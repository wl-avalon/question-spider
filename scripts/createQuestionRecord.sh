#!/bash/bin
phpCommand=/usr/bin/php
spIndexPath=/home/saber/webroot/study-palace/question-spider/console/index.php
spPath=/home/saber/webroot/study-palace
spCommand=main/index

${phpCommand} ${spIndexPath} ${spCommand} 语文 1 1019523 chinese >${spPath}/logs/chinese &
${phpCommand} ${spIndexPath} ${spCommand} 数学 2 1002865 math >${spPath}/logs/math &
${phpCommand} ${spIndexPath} ${spCommand} 英语 3 1034743 english >${spPath}/logs/englich &
${phpCommand} ${spIndexPath} ${spCommand} 物理 4 1101089 physical >${spPath}/logs/physical &
${phpCommand} ${spIndexPath} ${spCommand} 化学 5 1029281 chemistry >${spPath}/logs/chemistry &
${phpCommand} ${spIndexPath} ${spCommand} 生物 6 1041385 biological >${spPath}/logs/biological &
${phpCommand} ${spIndexPath} ${spCommand} 历史 7 1061557 history >${spPath}/logs/history &
#${phpCommand} ${spIndexPath} ${spCommand} 政治 8 1081975 political >${spPath}/logs/political &
${phpCommand} ${spIndexPath} ${spCommand} 地理 9 1022001 geography >${spPath}/logs/geography &
#${phpCommand} ${spIndexPath} ${spCommand} 通用技术 10 common_technology >${spPath}/logs/common_technology 2>&1 &
#${phpCommand} ${spIndexPath} ${spCommand} 信息技术 0 internet_technology >${spPath}/logs/internet_technology 2>&1 &