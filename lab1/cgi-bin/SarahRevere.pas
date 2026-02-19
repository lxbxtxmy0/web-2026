PROGRAM PaulRevere(INPUT,OUTPUT);       
USES
  DOS;                                                                         
VAR
  Lanterns: STRING;
  PosLanterns: INTEGER;
  QueryString: STRING;
BEGIN {PaulRevere}
  QueryString := GetEnv('QUERY_STRING');
  PosLanterns := POS('lanterns=', QueryString) ;
  Lanterns := COPY(QueryString, PosLanterns + 9, 1);
  WRITELN('Content-Type: text/plain');
  WRITELN;
  IF Lanterns = '1'   
    THEN
      WRITELN('The British are coming by land.')
    ELSE
      IF Lanterns = '2'
      THEN
        WRITELN('The British are coming by sea.')
      ELSE
        WRITELN('The North Church shows only ''', Lanterns, '''.')
END. {PaulRevere}