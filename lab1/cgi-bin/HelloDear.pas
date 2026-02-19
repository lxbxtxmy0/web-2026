PROGRAM HelloDear(INPUT, OUTPUT);
USES
  DOS;
VAR
  QueryString, Name: STRING;
  PosName: INTEGER;
BEGIN
  WRITELN('Content-Type: text/plain');
  WRITELN;
  QueryString := GetEnv('QUERY_STRING');
  PosName := POS('name=', QueryString);
  IF PosName <> 0
  THEN
    BEGIN
      Name := COPY(QueryString, PosName + 5);
      WRITELN('Hello dear, ', Name, '!')
    END
  ELSE
    WRITELN('Hello Anonymous!')  
END.