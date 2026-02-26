PROGRAM HelloDear(INPUT, OUTPUT);
USES
  DOS;
VAR
  QueryString, Name: STRING;
  PosName, Next: INTEGER;
BEGIN
  WRITELN('Content-Type: text/plain');
  WRITELN;
  QueryString := GetEnv('QUERY_STRING');
  PosName := POS('name=', QueryString);
  IF PosName = 1
  THEN
    BEGIN
      Next := POS('&', QueryString);
      IF Next > 0
      THEN 
        Name := COPY(QueryString, PosName + 5, Next - (PosName + 5))
      ELSE
        Name := COPY(QueryString, PosName + 5);
      WRITELN('Hello dear, ', Name, '!')
    END
  ELSE
    WRITELN('Hello Anonymous!')  
END.