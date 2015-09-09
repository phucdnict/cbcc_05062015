#!/bin/bash
FILENAME=/opt/backupmysql-`date +%s`.sql
mysqldump –user=root –password= > $FILENAME cbcc_local
            tar -zcf $FILENAME.tar.gz $FILENAME
            
cp -r E:\Code\cbcc\bak050615/* /opt/backup            
        
tar -zcvf backup-`date +%s`.tar.gz  /opt/backup/
