DELIMITER $$
CREATE PROCEDURE sp_DeleteBlogPost
(	
    IN Param_BlogID INT
)
BEGIN
	DELETE
	FROM
		POST
	WHERE
		ID = Param_BlogID;
END$$
DELIMITER ;