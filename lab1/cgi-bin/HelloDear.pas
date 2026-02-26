PROGRAM HelloDear(INPUT, OUTPUT);
USES
  DOS;
VAR
  QueryString, Name: STRING;
  PosName, AmpPos: INTEGER;
BEGIN
  WRITELN('Content-Type: text/plain');
  WRITELN;  
  QueryString := GetEnv('QUERY_STRING');
  PosName := POS('name=', QueryString);  
  IF PosName > 0
  THEN
    BEGIN
      AmpPos := POS('&', COPY(QueryString, PosName + 5, LENGTH(QueryString)));
      IF AmpPos > 0 
      THEN
        Name := COPY(QueryString, PosName + 5, AmpPos - 1)
      ELSE
        Name := COPY(QueryString, PosName + 5);      
      IF Name <> ''
      THEN
        WRITELN('Hello dear, ', Name, '!')
      ELSE
        WRITELN('Hello Anonymous!')
    END
  ELSE
    WRITELN('Hello Anonymous!')  
END.