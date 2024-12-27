SELECT DISTINCT d.*
FROM drive d
JOIN student s
ON d.Marks_10th <= s.Marks_10th
   AND d.Marks_12th <= s.Marks_12th
   AND d.Marks_UG <= s.Marks_UG
   AND d.CGPA <= s.CGPA
   AND d.Backlogs <= s.Stud_Backlogs
   AND FIND_IN_SET(s.Stud_Batch, d.Branch) > 0
   AND FIND_IN_SET(s.Stud_Course, d.Course) > 0
   AND d.Backlogs <= s.Stud_Backlogs
WHERE s.Stud_ID='23MCA08' AND FIND_IN_SET(s.Stud_Batch, d.Branch) > 0 AND FIND_IN_SET(s.Stud_Course, d.Course) > 0


SELECT * FROM drive d, student s WHERE FIND_IN_SET(s.Stud_Batch, d.Branch) > 0;
SELECT * FROM drive d, student s WHERE FIND_IN_SET(s.Stud_Course, d.Course) > 0 AND FIND_IN_SET(s.Stud_Batch, d.Branch) > 0 AND s.Stud_ID='23MCA08' AND d.Marks_10th <= s.Marks_10th AND d.Marks_12th <= s.Marks_12th AND d.Marks_UG <= s.Marks_UG AND d.CGPA <= s.CGPA AND d.Backlogs <= s.Stud_Backlogs;


SELECT d.D_ID, d.D_Name, d.D_Date, COUNT(a.App_ID) FROM drive d, application a WHERE a.D_ID = d.D_ID GROUP BY d.D_ID, d.D_Name, d.D_Date;

SELECT s.Stud_Batch, COUNT(DISTINCT s.Stud_ID) AS Student_Count FROM drive d, student s WHERE FIND_IN_SET(s.Stud_Course, d.Course) > 0 AND FIND_IN_SET(s.Stud_Batch, d.Branch) > 0 AND d.Year = s.Stud_Year AND d.Marks_10th <= s.Marks_10th AND d.Marks_12th <= s.Marks_12th AND (s.Marks_UG <= 0 OR d.Marks_UG <= s.Marks_UG) AND d.CGPA <= s.CGPA AND d.Backlogs <= s.Stud_Backlogs AND d.D_Package <= s.Stud_Package GROUP BY s.Stud_Batch;

SELECT D.D_ID, COUNT(DISTINCT s.Stud_ID) AS Student_Count FROM drive d, student s WHERE FIND_IN_SET(s.Stud_Course, d.Course) > 0 
AND FIND_IN_SET(s.Stud_Batch, d.Branch) > 0 
AND d.Year = s.Stud_Year 
AND d.Marks_10th <= s.Marks_10th 
AND d.Marks_12th <= s.Marks_12th 
AND (s.Marks_UG <= 0 OR d.Marks_UG <= s.Marks_UG) 
AND d.CGPA <= s.CGPA 
AND d.Backlogs <= s.Stud_Backlogs 
AND d.D_Package <= s.Stud_Package 
AND D.D_ID=1;

SELECT d.*, COUNT(DISTINCT s.Stud_ID) AS Stud_Count, COUNT(DISTINCT a.App_ID) as App_Count FROM drive d, student s, application a WHERE FIND_IN_SET(s.Stud_Course, d.Course) > 0 
AND FIND_IN_SET(s.Stud_Batch, d.Branch) > 0 
AND d.Year = s.Stud_Year 
AND d.Marks_10th <= s.Marks_10th 
AND d.Marks_12th <= s.Marks_12th 
AND (s.Marks_UG <= 0 OR d.Marks_UG <= s.Marks_UG) 
AND d.CGPA <= s.CGPA 
AND d.Backlogs <= s.Stud_Backlogs 
AND d.D_Package <= s.Stud_Package GROUP BY D.D_ID
AND a.D_ID=1;

SELECT d.*, COUNT(DISTINCT s.Stud_ID) AS Stud_Count, COUNT(DISTINCT a.S_ID) as App_Count FROM drive d, student s, application a WHERE FIND_IN_SET(s.Stud_Course, d.Course) > 0 
AND FIND_IN_SET(s.Stud_Batch, d.Branch) > 0 
AND d.Year = s.Stud_Year 
AND d.Marks_10th <= s.Marks_10th 
AND d.Marks_12th <= s.Marks_12th 
AND (s.Marks_UG <= 0 OR d.Marks_UG <= s.Marks_UG) 
AND d.CGPA <= s.CGPA 
AND d.Backlogs <= s.Stud_Backlogs 
AND d.D_Package <= s.Stud_Package 
AND d.D_ID=a.App_ID GROUP BY d.D_ID;

$query="SELECT D.*, COUNT(DISTINCT s.Stud_ID) AS Stud_Count FROM drive d, student s WHERE FIND_IN_SET(s.Stud_Course, d.Course) > 0 
										AND FIND_IN_SET(s.Stud_Batch, d.Branch) > 0 
										AND d.Year = s.Stud_Year 
										AND d.Marks_10th <= s.Marks_10th 
										AND d.Marks_12th <= s.Marks_12th 
										AND (s.Marks_UG <= 0 OR d.Marks_UG <= s.Marks_UG) 
										AND d.CGPA <= s.CGPA 
										AND d.Backlogs <= s.Stud_Backlogs 
										AND d.D_Package <= s.Stud_Package GROUP BY D.D_ID";


SELECT 
    d.*, 
    COUNT(DISTINCT s.Stud_ID) AS Stud_Count,
    COUNT(DISTINCT a.App_ID) AS App_Count
FROM 
    drive d
LEFT JOIN student s 
    ON FIND_IN_SET(s.Stud_Course, d.Course) > 0 
    AND FIND_IN_SET(s.Stud_Batch, d.Branch) > 0 
    AND d.Year = s.Stud_Year 
    AND d.Marks_10th <= s.Marks_10th 
    AND d.Marks_12th <= s.Marks_12th 
    AND (s.Marks_UG <= 0 OR d.Marks_UG <= s.Marks_UG) 
    AND d.CGPA <= s.CGPA 
    AND d.Backlogs <= s.Stud_Backlogs 
    AND d.D_Package <= s.Stud_Package
LEFT JOIN application a 
    ON a.D_ID = d.D_ID
GROUP BY d.D_ID;

-- Query to find applied and not applied students for a specific drive
SELECT 
    s.Stud_ID, 
    s.Stud_Name, 
    CASE 
        WHEN a.App_ID IS NOT NULL THEN 'Applied'
        ELSE 'Not Applied'
    END AS Application_Status
FROM 
    student s
LEFT JOIN drive d 
    ON FIND_IN_SET(s.Stud_Course, d.Course) > 0 
    AND FIND_IN_SET(s.Stud_Batch, d.Branch) > 0 
    AND d.Year = s.Stud_Year 
    AND d.Marks_10th <= s.Marks_10th 
    AND d.Marks_12th <= s.Marks_12th 
    AND (s.Marks_UG <= 0 OR d.Marks_UG <= s.Marks_UG) 
    AND d.CGPA <= s.CGPA 
    AND d.Backlogs <= s.Stud_Backlogs 
    AND d.D_Package <= s.Stud_Package
LEFT JOIN application a 
    ON a.D_ID = d.D_ID 
    AND a.S_ID = s.Stud_ID
WHERE 
    d.D_ID = 1
    AND s.Stud_Batch = 'Computer Applications'
ORDER BY Application_Status;