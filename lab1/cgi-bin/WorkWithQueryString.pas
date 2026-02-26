PROGRAM WorkWithQueryString(INPUT, OUTPUT);
USES
  DOS;  
VAR
  QueryString: STRING;  
FUNCTION GetQueryStringParameter(Key: STRING): STRING;
VAR
  StartPos, EndPos: INTEGER;
  SupStr: STRING;  
BEGIN
  StartPos := Pos(Key + '=', QueryString);
  IF StartPos > 0
  THEN
    BEGIN
      StartPos := StartPos + Length(Key + '=');
      SupStr := Copy(QueryString, StartPos, Length(QueryString));
      EndPos := Pos('&', SupStr);
      IF EndPos > 0 THEN
        GetQueryStringParameter := Copy(SupStr, 1, EndPos - 1)
      ELSE
        GetQueryStringParameter := SupStr
    END
END; 

BEGIN 
  QueryString := GetEnv('QUERY_STRING');
  WRITELN('Content-Type: text/plain');
  WRITELN;
  WRITELN('First Name: ', GetQueryStringParameter('first_name'));
  WRITELN('Last Name: ', GetQueryStringParameter('last_name'));
  WRITELN('Age: ', GetQueryStringParameter('age'))
END.