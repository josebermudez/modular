#genera actualización sobre la base de datos, no se usa el context nuevo para evitar ejecutar el changeLog del estado
#inicial de la base de datos
java -jar liquibase-3.3.2-bin/liquibase.jar --driver=org.postgresql.Driver --classpath=postgresql-9.3-1102.jdbc3.jar --url=jdbc:postgresql://192.168.33.10/demosolati --username=postgres --password= --changeLogFile=adminfosmartchangelog/adminfosmart.db.changelog.master.xml --contexts=!nuevo update


#username=user
#password=123
# default changelog to use, relative to classpath

### DIFF params ###
#referenceUrl=jdbc:postgresql://localhost:5432/wegas_dev
#referenceUsername=user
#referencePassword=123
#Genera el changeLog de una base de datos existente
#java -jar liquibase-3.3.2-bin/liquibase.jar --driver=org.postgresql.Driver --classpath=postgresql-9.3-1102.jdbc3.jar --#url=jdbc:postgresql://192.168.33.10/demosolati --username=postgres --password= --changeLogFile=adminfosmartchangelog/db.changelog-1.0.xml #generateChangeLog
