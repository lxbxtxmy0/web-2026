PROGRAM WorkWithQueryString(INPUT, OUTPUT);
USES
  DOS;  
VAR
  QueryString: STRING;
  
FUNCTION GetQueryStringParameter(Key: STRING): STRING;
VAR
  LeftP, RightP, Start: INTEGER;
  SubStr: STRING;
BEGIN 
  LeftP := Pos(Key + '=', QueryString);
  IF LeftP <> 0
  THEN
    BEGIN
      Start := LeftP + Length(Key) + 1;
      SubStr := Copy(QueryString, Start, Length(QueryString));
      RightP := Pos('&', SubStr);
      IF RightP <> 0
      THEN
        GetQueryStringParameter := Copy(SubStr, 1, RightP - 1)
      ELSE
        GetQueryStringParameter := Copy(SubStr, 1, Length(SubStr))
    END
  ELSE
    GetQueryStringParameter := 'parameter ' +  Key + ' does not exist!'
END;
 
BEGIN 
  QueryString := GetEnv('QUERY_STRING');
  WRITELN('Content-Type: text/plain');
  WRITELN;
  WRITELN('First Name: ', GetQueryStringParameter('first_name'));
  WRITELN('Last Name: ', GetQueryStringParameter('last_name'));
  WRITELN('Age: ', GetQueryStringParameter('age'))
END. 


