DROP PROCEDURE IF EXISTS [dbo].[Register];
GO
CREATE PROCEDURE [dbo].[Register] (
    @first_name NVARCHAR(50),
    @last_name NVARCHAR(50),
    @password NVARCHAR(100),
    @email NVARCHAR(50),
    @response NVARCHAR(1000) OUTPUT
) 
AS 
BEGIN TRANSACTION
    DECLARE @id INT;
    DECLARE @hashed_pw VARBINARY(8000);
    BEGIN TRY
        IF (SELECT [email] FROM [dbo].[Users] WHERE [email] = @email) IS NULL
            BEGIN
                SET @hashed_pw = HASHBYTES('SHA2_256', @password);
                INSERT INTO [Users]([first_name], [last_name], [email], [password]) VALUES(@first_name, @last_name, @email, @hashed_pw)
                COMMIT
                SET @id = (SELECT user_id FROM Users WHERE [email] = @email)
                SET @response = CONCAT(N'200, ', @id);
            END
        ELSE
            BEGIN
                SET @response = N'208';
                ROLLBACK
            END
    END TRY
    BEGIN CATCH
        --if an exception occurs execute your rollback
        IF @@TRANCOUNT > 0 ROLLBACK  
        PRINT ERROR_MESSAGE()
        SET @response = N'404';
    END CATCH
;
GO
DROP PROCEDURE IF EXISTS [dbo].[ValidateUser];
GO
CREATE PROCEDURE [dbo].[ValidateUser] (
    @email NVARCHAR(50),
    @password NVARCHAR(100)

)
AS
    DECLARE @stored_pass VARBINARY(8000)
    DECLARE @hashed_pw VARBINARY(8000);
    DECLARE @id INT
    BEGIN TRY
        SET @hashed_pw = HASHBYTES('SHA2_256', @password);
        SET @stored_pass = (SELECT [password] FROM Users WHERE email = @email)
        IF (@stored_pass = @hashed_pw)
            BEGIN
                SET @id = (SELECT [user_id] FROM Users WHERE email = @email)
                INSERT INTO [dbo].[Sessions](user_id) VALUES (@id)
                RETURN 1
            END
        ELSE
            BEGIN
                RETURN 0
            END
    END TRY
    BEGIN CATCH
        PRINT ERROR_MESSAGE()
        RETURN 0;
    END CATCH
;
GO
DROP PROCEDURE IF EXISTS [dbo].[UpdateUser];
GO
CREATE PROCEDURE [dbo].[UpdateUser] (
    @first_name NVARCHAR(50),
    @last_name NVARCHAR(50),
    @email NVARCHAR(50),
    @password NVARCHAR(100),
    @id INT
)
AS
    DECLARE @new_first_name NVARCHAR(50),
            @new_last_name NVARCHAR(50),
            @new_email NVARCHAR(50),
            @new_password VARBINARY(8000),
            @old_password VARBINARY(8000)
    BEGIN TRANSACTION
        BEGIN TRY
            SET @new_first_name = (SELECT ISNULL(@first_name, (SELECT [first_name] FROM Users WHERE user_id = @id)))
            SET @new_last_name = (SELECT ISNULL(@last_name, (SELECT [last_name] FROM Users WHERE user_id = @id)))
            SET @new_email = (SELECT ISNULL(@email, (SELECT [email] FROM Users WHERE user_id = @id)))
            -- If incoming password isn't null, update the old password audit table
            IF @password IS NOT NULL
                BEGIN
                    SET @old_password = (SELECT [password] FROM Users WHERE user_id = @id)
                    INSERT INTO [dbo].[Passwords]([user_id], [password]) VALUES(@id, @old_password)
                    SET @new_password = HASHBYTES('SHA2_256', @password)
                END
            ELSE
                BEGIN
                    SET @new_password = (SELECT [password] FROM Users WHERE user_id = @id)
                END
            UPDATE Users SET [first_name] = @new_first_name, [last_name] = @new_last_name, [email] = @new_email, [password] = @new_password
            WHERE [user_id] = @id
            COMMIT
        END TRY
        BEGIN CATCH
            PRINT ERROR_MESSAGE()
            ROLLBACK
        END CATCH
;
GO
DROP PROCEDURE IF EXISTS [dbo].[DeleteUser];
GO
CREATE PROCEDURE [dbo].[DeleteUser] (
    @id INT
)
AS
    BEGIN TRANSACTION
        BEGIN TRY
            DELETE FROM [dbo].[Sessions] WHERE [user_id] = @id
            DELETE FROM [dbo].[Passwords] WHERE [user_id] = @id
            DELETE FROM [dbo].[Users] WHERE [user_id] = @id
            COMMIT
        END TRY
        BEGIN CATCH
            PRINT ERROR_MESSAGE()
            ROLLBACK
        END CATCH
;
GO