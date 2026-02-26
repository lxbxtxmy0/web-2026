PROGRAM SarahRevere(INPUT, OUTPUT);
USES
  DOS;                                                                         
VAR
  Lanterns: STRING;
  QueryString: STRING;
BEGIN {SarahRevere}
  QueryString := GetEnv('QUERY_STRING');  
  IF QueryString = 'lanterns=1'
  THEN
    Lanterns := '1'
  ELSE 
    IF QueryString = 'lanterns=2' 
    THEN
        Lanterns := '2'
    ELSE
        Lanterns := '';    
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
        WRITELN('The North Church shows only ''', Lanterns, '''.');
END. {SarahRevere}