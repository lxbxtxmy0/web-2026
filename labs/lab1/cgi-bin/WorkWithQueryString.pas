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
  StartPos := POS('&' + Key + '=', QueryString); 
  IF StartPos > 0 
  THEN
    BEGIN
      StartPos := StartPos + LENGTH(Key) + 2;
      SupStr := COPY(QueryString, StartPos);
      EndPos := POS('&', SupStr);      
      IF EndPos > 0
      THEN
        GetQueryStringParameter := COPY(QueryString, StartPos, EndPos - 1)
      ELSE
        GetQueryStringParameter := COPY(QueryString, StartPos)
    END
  ELSE
    GetQueryStringParameter := ''
END; 

BEGIN 
  QueryString := '&' + GetEnv('QUERY_STRING');
  WRITELN('Content-Type: text/plain');
  WRITELN;
  WRITELN('First Name: ', GetQueryStringParameter('first_name'));
  WRITELN('Last Name: ', GetQueryStringParameter('last_name'));
  WRITELN('Age: ', GetQueryStringParameter('age'))
END.