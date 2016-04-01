#genera actualización sobre la base de datos, no se usa el context nuevo para evitar ejecutar el changeLog del estado
#inicial de la base de datos
java -jar liquibase-3.3.2-bin/liquibase.jar --driver=com.mysql.jdbc.Driver --classpath=mysql-connector-java-5.1.34-bin.jar --url=jdbc:mysql://desarrollo.co6m76wcpiom.us-west-2.rds.amazonaws.com/modul4r4ppDB --username=jbermudez --password=R87eub%4YEJjXAT --changeLogFile=modularchangelog/modular.db.changelog.master.xml --contexts=!nuevo update
#java -jar liquibase-3.3.2-bin/liquibase.jar --driver=com.mysql.jdbc.Driver --classpath=mysql-connector-java-5.1.34-bin.jar --url=jdbc:mysql://desarrollo.co6m76wcpiom.us-west-2.rds.amazonaws.com/modul4r4ppDB --username=jbermudez --password=R87eub%4YEJjXAT --changeLogFile=modularchangelog/modular.db.changelog.master.xml --contexts=nuevo update



#username=user
#password=123
# default changelog to use, relative to classpath

### DIFF params ###
#referenceUrl=jdbc:postgresql://localhost:5432/wegas_dev
#referenceUsername=user
#referencePassword=123
#Genera el changeLog de una base de datos existente
#java -jar liquibase-3.3.2-bin/liquibase.jar --driver=org.postgresql.Driver --classpath=postgresql-9.3-1102.jdbc3.jar --#url=jdbc:postgresql://192.168.33.10/demosolati --username=postgres --password= --changeLogFile=adminfosmartchangelog/db.changelog-1.0.xml #generateChangeLog
