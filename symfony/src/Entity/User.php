<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use App\Repository\UserRepository;
use Doctrine\Common\Collections\Criteria;
use Doctrine\Common\Collections\Collection;
use Doctrine\Common\Collections\ArrayCollection;
use Symfony\Component\Security\Core\User\UserInterface;

/**
 * User
 *
 * @ORM\Table(name="b_user", uniqueConstraints={@ORM\UniqueConstraint(name="ix_login", columns={"LOGIN", "EXTERNAL_AUTH_ID"})}, indexes={@ORM\Index(name="ix_b_user_activity_date", columns={"LAST_ACTIVITY_DATE"}), @ORM\Index(name="ix_user_last_login", columns={"LAST_LOGIN"}), @ORM\Index(name="ix_b_user_email", columns={"EMAIL"}), @ORM\Index(name="IX_B_USER_XML_ID", columns={"XML_ID"}), @ORM\Index(name="ix_user_date_register", columns={"DATE_REGISTER"})})
 * @ORM\Entity(repositoryClass=UserRepository::class)
 */
class User implements UserInterface
{
    /**
     * @var int
     *
     * @ORM\Column(name="ID", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $id;

    /**
     * @var \DateTime|null
     *
     * @ORM\Column(name="TIMESTAMP_X", type="datetime", nullable=true)
     */
    private $timestampX;

    /**
     * @var string
     *
     * @ORM\Column(name="LOGIN", type="string", length=50, nullable=false)
     */
    private $login;

    /**
     * @var string
     *
     * @ORM\Column(name="PASSWORD", type="string", length=255, nullable=false)
     */
    private $password;

    /**
     * @var string|null
     *
     * @ORM\Column(name="CHECKWORD", type="string", length=255, nullable=true)
     */
    private $checkword;

    /**
     * @var string
     *
     * @ORM\Column(name="ACTIVE", type="string", length=1, nullable=false, options={"default"="Y","fixed"=true})
     */
    private $active = 'Y';

    /**
     * @var string|null
     *
     * @ORM\Column(name="NAME", type="string", length=50, nullable=true)
     */
    private $name;

    /**
     * @var string|null
     *
     * @ORM\Column(name="LAST_NAME", type="string", length=50, nullable=true)
     */
    private $lastName;

    /**
     * @var string|null
     *
     * @ORM\Column(name="EMAIL", type="string", length=255, nullable=true)
     */
    private $email;

    /**
     * @var \DateTime|null
     *
     * @ORM\Column(name="LAST_LOGIN", type="datetime", nullable=true)
     */
    private $lastLogin;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="DATE_REGISTER", type="datetime", nullable=false)
     */
    private $dateRegister;

    /**
     * @var string|null
     *
     * @ORM\Column(name="LID", type="string", length=2, nullable=true, options={"fixed"=true})
     */
    private $lid;

    /**
     * @var string|null
     *
     * @ORM\Column(name="PERSONAL_PROFESSION", type="string", length=255, nullable=true)
     */
    private $personalProfession;

    /**
     * @var string|null
     *
     * @ORM\Column(name="PERSONAL_WWW", type="string", length=255, nullable=true)
     */
    private $personalWww;

    /**
     * @var string|null
     *
     * @ORM\Column(name="PERSONAL_ICQ", type="string", length=255, nullable=true)
     */
    private $personalIcq;

    /**
     * @var string|null
     *
     * @ORM\Column(name="PERSONAL_GENDER", type="string", length=1, nullable=true, options={"fixed"=true})
     */
    private $personalGender;

    /**
     * @var string|null
     *
     * @ORM\Column(name="PERSONAL_BIRTHDATE", type="string", length=50, nullable=true)
     */
    private $personalBirthdate;

    /**
     * @var int|null
     *
     * @ORM\Column(name="PERSONAL_PHOTO", type="integer", nullable=true)
     */
    private $personalPhoto;

    /**
     * @var string|null
     *
     * @ORM\Column(name="PERSONAL_PHONE", type="string", length=255, nullable=true)
     */
    private $personalPhone;

    /**
     * @var string|null
     *
     * @ORM\Column(name="PERSONAL_FAX", type="string", length=255, nullable=true)
     */
    private $personalFax;

    /**
     * @var string|null
     *
     * @ORM\Column(name="PERSONAL_MOBILE", type="string", length=255, nullable=true)
     */
    private $personalMobile;

    /**
     * @var string|null
     *
     * @ORM\Column(name="PERSONAL_PAGER", type="string", length=255, nullable=true)
     */
    private $personalPager;

    /**
     * @var string|null
     *
     * @ORM\Column(name="PERSONAL_STREET", type="text", length=65535, nullable=true)
     */
    private $personalStreet;

    /**
     * @var string|null
     *
     * @ORM\Column(name="PERSONAL_MAILBOX", type="string", length=255, nullable=true)
     */
    private $personalMailbox;

    /**
     * @var string|null
     *
     * @ORM\Column(name="PERSONAL_CITY", type="string", length=255, nullable=true)
     */
    private $personalCity;

    /**
     * @var string|null
     *
     * @ORM\Column(name="PERSONAL_STATE", type="string", length=255, nullable=true)
     */
    private $personalState;

    /**
     * @var string|null
     *
     * @ORM\Column(name="PERSONAL_ZIP", type="string", length=255, nullable=true)
     */
    private $personalZip;

    /**
     * @var string|null
     *
     * @ORM\Column(name="PERSONAL_COUNTRY", type="string", length=255, nullable=true)
     */
    private $personalCountry;

    /**
     * @var string|null
     *
     * @ORM\Column(name="PERSONAL_NOTES", type="text", length=65535, nullable=true)
     */
    private $personalNotes;

    /**
     * @var string|null
     *
     * @ORM\Column(name="WORK_COMPANY", type="string", length=255, nullable=true)
     */
    private $workCompany;

    /**
     * @var string|null
     *
     * @ORM\Column(name="WORK_DEPARTMENT", type="string", length=255, nullable=true)
     */
    private $workDepartment;

    /**
     * @var string|null
     *
     * @ORM\Column(name="WORK_POSITION", type="string", length=255, nullable=true)
     */
    private $workPosition;

    /**
     * @var string|null
     *
     * @ORM\Column(name="WORK_WWW", type="string", length=255, nullable=true)
     */
    private $workWww;

    /**
     * @var string|null
     *
     * @ORM\Column(name="WORK_PHONE", type="string", length=255, nullable=true)
     */
    private $workPhone;

    /**
     * @var string|null
     *
     * @ORM\Column(name="WORK_FAX", type="string", length=255, nullable=true)
     */
    private $workFax;

    /**
     * @var string|null
     *
     * @ORM\Column(name="WORK_PAGER", type="string", length=255, nullable=true)
     */
    private $workPager;

    /**
     * @var string|null
     *
     * @ORM\Column(name="WORK_STREET", type="text", length=65535, nullable=true)
     */
    private $workStreet;

    /**
     * @var string|null
     *
     * @ORM\Column(name="WORK_MAILBOX", type="string", length=255, nullable=true)
     */
    private $workMailbox;

    /**
     * @var string|null
     *
     * @ORM\Column(name="WORK_CITY", type="string", length=255, nullable=true)
     */
    private $workCity;

    /**
     * @var string|null
     *
     * @ORM\Column(name="WORK_STATE", type="string", length=255, nullable=true)
     */
    private $workState;

    /**
     * @var string|null
     *
     * @ORM\Column(name="WORK_ZIP", type="string", length=255, nullable=true)
     */
    private $workZip;

    /**
     * @var string|null
     *
     * @ORM\Column(name="WORK_COUNTRY", type="string", length=255, nullable=true)
     */
    private $workCountry;

    /**
     * @var string|null
     *
     * @ORM\Column(name="WORK_PROFILE", type="text", length=65535, nullable=true)
     */
    private $workProfile;

    /**
     * @var int|null
     *
     * @ORM\Column(name="WORK_LOGO", type="integer", nullable=true)
     */
    private $workLogo;

    /**
     * @var string|null
     *
     * @ORM\Column(name="WORK_NOTES", type="text", length=65535, nullable=true)
     */
    private $workNotes;

    /**
     * @var string|null
     *
     * @ORM\Column(name="ADMIN_NOTES", type="text", length=65535, nullable=true)
     */
    private $adminNotes;

    /**
     * @var string|null
     *
     * @ORM\Column(name="STORED_HASH", type="string", length=32, nullable=true)
     */
    private $storedHash;

    /**
     * @var string|null
     *
     * @ORM\Column(name="XML_ID", type="string", length=255, nullable=true)
     */
    private $xmlId;

    /**
     * @var \DateTime|null
     *
     * @ORM\Column(name="PERSONAL_BIRTHDAY", type="date", nullable=true)
     */
    private $personalBirthday;

    /**
     * @var string|null
     *
     * @ORM\Column(name="EXTERNAL_AUTH_ID", type="string", length=255, nullable=true)
     */
    private $externalAuthId;

    /**
     * @var \DateTime|null
     *
     * @ORM\Column(name="CHECKWORD_TIME", type="datetime", nullable=true)
     */
    private $checkwordTime;

    /**
     * @var string|null
     *
     * @ORM\Column(name="SECOND_NAME", type="string", length=50, nullable=true)
     */
    private $secondName;

    /**
     * @var string|null
     *
     * @ORM\Column(name="CONFIRM_CODE", type="string", length=8, nullable=true)
     */
    private $confirmCode;

    /**
     * @var int|null
     *
     * @ORM\Column(name="LOGIN_ATTEMPTS", type="integer", nullable=true)
     */
    private $loginAttempts;

    /**
     * @var \DateTime|null
     *
     * @ORM\Column(name="LAST_ACTIVITY_DATE", type="datetime", nullable=true)
     */
    private $lastActivityDate;

    /**
     * @var string|null
     *
     * @ORM\Column(name="AUTO_TIME_ZONE", type="string", length=1, nullable=true, options={"fixed"=true})
     */
    private $autoTimeZone;

    /**
     * @var string|null
     *
     * @ORM\Column(name="TIME_ZONE", type="string", length=50, nullable=true)
     */
    private $timeZone;

    /**
     * @var int|null
     *
     * @ORM\Column(name="TIME_ZONE_OFFSET", type="integer", nullable=true)
     */
    private $timeZoneOffset;

    /**
     * @var string|null
     *
     * @ORM\Column(name="TITLE", type="string", length=255, nullable=true)
     */
    private $title;

    /**
     * @var string|null
     *
     * @ORM\Column(name="BX_USER_ID", type="string", length=32, nullable=true)
     */
    private $bxUserId;

    /**
     * @var string|null
     *
     * @ORM\Column(name="LANGUAGE_ID", type="string", length=2, nullable=true, options={"fixed"=true})
     */
    private $languageId;

    /**
     * @var string
     *
     * @ORM\Column(name="BLOCKED", type="string", length=1, nullable=false, options={"default"="N","fixed"=true})
     */
    private $blocked = 'N';

    /**
     * @ORM\OneToMany(targetEntity=User\Group::class, cascade={"persist"}, mappedBy="user", orphanRemoval=true)
     */
    private $groups;

    /**
     * @ORM\ManyToOne(targetEntity=File::class)
     * @ORM\JoinColumn(name="PERSONAL_PHOTO", referencedColumnName="ID")
     */
    private $picture;

    /**
     * @ORM\ManyToOne(targetEntity=File::class)
     * @ORM\JoinColumn(name="WORK_LOGO", referencedColumnName="ID")
     */
    private $logoPicture;

    public function __construct()
    {
        $this->groups = new ArrayCollection();
    }

    /**
     * @see UserInterface
     */
    public function getRoles()
    {
        $roles = [];

        /** @var User\Group $relation */
        foreach ($this->getGroups() as $relation) {
            if ($relation->isActive()) {
                $roles[] = $relation->getGroup()->getStringId();
            }
        }

        return array_unique($roles);
    }

    /**
     * @see UserInterface
     */
    public function getSalt()
    {
        return null;
    }

    /**
     * A visual identifier that represents this user.
     *
     * @see UserInterface
     */
    public function getUsername()
    {
        return $this->getLogin();
    }

    /**
     * @see UserInterface
     */
    public function eraseCredentials()
    {

    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTimestampX(): ?\DateTimeInterface
    {
        return $this->timestampX;
    }

    public function setTimestampX(?\DateTimeInterface $timestampX): self
    {
        $this->timestampX = $timestampX;

        return $this;
    }

    public function getLogin(): ?string
    {
        return $this->login;
    }

    public function setLogin(string $login): self
    {
        $this->login = $login;

        return $this;
    }

    public function getPassword(): ?string
    {
        return $this->password;
    }

    public function setPassword(string $password): self
    {
        $this->password = $password;

        return $this;
    }

    public function getCheckword(): ?string
    {
        return $this->checkword;
    }

    public function setCheckword(?string $checkword): self
    {
        $this->checkword = $checkword;

        return $this;
    }

    public function getActive(): ?string
    {
        return $this->active;
    }

    public function setActive(string $active): self
    {
        $this->active = $active;

        return $this;
    }

    public function isActive(): bool
    {
        return $this->active === 'Y';
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(?string $name): self
    {
        $this->name = $name;

        return $this;
    }

    public function getLastName(): ?string
    {
        return $this->lastName;
    }

    public function setLastName(?string $lastName): self
    {
        $this->lastName = $lastName;

        return $this;
    }

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function setEmail(?string $email): self
    {
        $this->email = $email;

        return $this;
    }

    public function getLastLogin(): ?\DateTimeInterface
    {
        return $this->lastLogin;
    }

    public function setLastLogin(?\DateTimeInterface $lastLogin): self
    {
        $this->lastLogin = $lastLogin;

        return $this;
    }

    public function getDateRegister(): ?\DateTimeInterface
    {
        return $this->dateRegister;
    }

    public function setDateRegister(\DateTimeInterface $dateRegister): self
    {
        $this->dateRegister = $dateRegister;

        return $this;
    }

    public function getLid(): ?string
    {
        return $this->lid;
    }

    public function setLid(?string $lid): self
    {
        $this->lid = $lid;

        return $this;
    }

    public function getPersonalProfession(): ?string
    {
        return $this->personalProfession;
    }

    public function setPersonalProfession(?string $personalProfession): self
    {
        $this->personalProfession = $personalProfession;

        return $this;
    }

    public function getPersonalWww(): ?string
    {
        return $this->personalWww;
    }

    public function setPersonalWww(?string $personalWww): self
    {
        $this->personalWww = $personalWww;

        return $this;
    }

    public function getPersonalIcq(): ?string
    {
        return $this->personalIcq;
    }

    public function setPersonalIcq(?string $personalIcq): self
    {
        $this->personalIcq = $personalIcq;

        return $this;
    }

    public function getPersonalGender(): ?string
    {
        return $this->personalGender;
    }

    public function setPersonalGender(?string $personalGender): self
    {
        $this->personalGender = $personalGender;

        return $this;
    }

    public function getPersonalBirthdate(): ?string
    {
        return $this->personalBirthdate;
    }

    public function setPersonalBirthdate(?string $personalBirthdate): self
    {
        $this->personalBirthdate = $personalBirthdate;

        return $this;
    }

    public function getPersonalPhoto(): ?int
    {
        return $this->personalPhoto;
    }

    public function setPersonalPhoto(?int $personalPhoto): self
    {
        $this->personalPhoto = $personalPhoto;

        return $this;
    }

    public function getPersonalPhone(): ?string
    {
        return $this->personalPhone;
    }

    public function setPersonalPhone(?string $personalPhone): self
    {
        $this->personalPhone = $personalPhone;

        return $this;
    }

    public function getPersonalFax(): ?string
    {
        return $this->personalFax;
    }

    public function setPersonalFax(?string $personalFax): self
    {
        $this->personalFax = $personalFax;

        return $this;
    }

    public function getPersonalMobile(): ?string
    {
        return $this->personalMobile;
    }

    public function setPersonalMobile(?string $personalMobile): self
    {
        $this->personalMobile = $personalMobile;

        return $this;
    }

    public function getPersonalPager(): ?string
    {
        return $this->personalPager;
    }

    public function setPersonalPager(?string $personalPager): self
    {
        $this->personalPager = $personalPager;

        return $this;
    }

    public function getPersonalStreet(): ?string
    {
        return $this->personalStreet;
    }

    public function setPersonalStreet(?string $personalStreet): self
    {
        $this->personalStreet = $personalStreet;

        return $this;
    }

    public function getPersonalMailbox(): ?string
    {
        return $this->personalMailbox;
    }

    public function setPersonalMailbox(?string $personalMailbox): self
    {
        $this->personalMailbox = $personalMailbox;

        return $this;
    }

    public function getPersonalCity(): ?string
    {
        return $this->personalCity;
    }

    public function setPersonalCity(?string $personalCity): self
    {
        $this->personalCity = $personalCity;

        return $this;
    }

    public function getPersonalState(): ?string
    {
        return $this->personalState;
    }

    public function setPersonalState(?string $personalState): self
    {
        $this->personalState = $personalState;

        return $this;
    }

    public function getPersonalZip(): ?string
    {
        return $this->personalZip;
    }

    public function setPersonalZip(?string $personalZip): self
    {
        $this->personalZip = $personalZip;

        return $this;
    }

    public function getPersonalCountry(): ?string
    {
        return $this->personalCountry;
    }

    public function setPersonalCountry(?string $personalCountry): self
    {
        $this->personalCountry = $personalCountry;

        return $this;
    }

    public function getPersonalNotes(): ?string
    {
        return $this->personalNotes;
    }

    public function setPersonalNotes(?string $personalNotes): self
    {
        $this->personalNotes = $personalNotes;

        return $this;
    }

    public function getWorkCompany(): ?string
    {
        return $this->workCompany;
    }

    public function setWorkCompany(?string $workCompany): self
    {
        $this->workCompany = $workCompany;

        return $this;
    }

    public function getWorkDepartment(): ?string
    {
        return $this->workDepartment;
    }

    public function setWorkDepartment(?string $workDepartment): self
    {
        $this->workDepartment = $workDepartment;

        return $this;
    }

    public function getWorkPosition(): ?string
    {
        return $this->workPosition;
    }

    public function setWorkPosition(?string $workPosition): self
    {
        $this->workPosition = $workPosition;

        return $this;
    }

    public function getWorkWww(): ?string
    {
        return $this->workWww;
    }

    public function setWorkWww(?string $workWww): self
    {
        $this->workWww = $workWww;

        return $this;
    }

    public function getWorkPhone(): ?string
    {
        return $this->workPhone;
    }

    public function setWorkPhone(?string $workPhone): self
    {
        $this->workPhone = $workPhone;

        return $this;
    }

    public function getWorkFax(): ?string
    {
        return $this->workFax;
    }

    public function setWorkFax(?string $workFax): self
    {
        $this->workFax = $workFax;

        return $this;
    }

    public function getWorkPager(): ?string
    {
        return $this->workPager;
    }

    public function setWorkPager(?string $workPager): self
    {
        $this->workPager = $workPager;

        return $this;
    }

    public function getWorkStreet(): ?string
    {
        return $this->workStreet;
    }

    public function setWorkStreet(?string $workStreet): self
    {
        $this->workStreet = $workStreet;

        return $this;
    }

    public function getWorkMailbox(): ?string
    {
        return $this->workMailbox;
    }

    public function setWorkMailbox(?string $workMailbox): self
    {
        $this->workMailbox = $workMailbox;

        return $this;
    }

    public function getWorkCity(): ?string
    {
        return $this->workCity;
    }

    public function setWorkCity(?string $workCity): self
    {
        $this->workCity = $workCity;

        return $this;
    }

    public function getWorkState(): ?string
    {
        return $this->workState;
    }

    public function setWorkState(?string $workState): self
    {
        $this->workState = $workState;

        return $this;
    }

    public function getWorkZip(): ?string
    {
        return $this->workZip;
    }

    public function setWorkZip(?string $workZip): self
    {
        $this->workZip = $workZip;

        return $this;
    }

    public function getWorkCountry(): ?string
    {
        return $this->workCountry;
    }

    public function setWorkCountry(?string $workCountry): self
    {
        $this->workCountry = $workCountry;

        return $this;
    }

    public function getWorkProfile(): ?string
    {
        return $this->workProfile;
    }

    public function setWorkProfile(?string $workProfile): self
    {
        $this->workProfile = $workProfile;

        return $this;
    }

    public function getWorkLogo(): ?int
    {
        return $this->workLogo;
    }

    public function setWorkLogo(?int $workLogo): self
    {
        $this->workLogo = $workLogo;

        return $this;
    }

    public function getWorkNotes(): ?string
    {
        return $this->workNotes;
    }

    public function setWorkNotes(?string $workNotes): self
    {
        $this->workNotes = $workNotes;

        return $this;
    }

    public function getAdminNotes(): ?string
    {
        return $this->adminNotes;
    }

    public function setAdminNotes(?string $adminNotes): self
    {
        $this->adminNotes = $adminNotes;

        return $this;
    }

    public function getStoredHash(): ?string
    {
        return $this->storedHash;
    }

    public function setStoredHash(?string $storedHash): self
    {
        $this->storedHash = $storedHash;

        return $this;
    }

    public function getXmlId(): ?string
    {
        return $this->xmlId;
    }

    public function setXmlId(?string $xmlId): self
    {
        $this->xmlId = $xmlId;

        return $this;
    }

    public function getPersonalBirthday(): ?\DateTimeInterface
    {
        return $this->personalBirthday;
    }

    public function setPersonalBirthday(?\DateTimeInterface $personalBirthday): self
    {
        $this->personalBirthday = $personalBirthday;

        return $this;
    }

    public function getExternalAuthId(): ?string
    {
        return $this->externalAuthId;
    }

    public function setExternalAuthId(?string $externalAuthId): self
    {
        $this->externalAuthId = $externalAuthId;

        return $this;
    }

    public function getCheckwordTime(): ?\DateTimeInterface
    {
        return $this->checkwordTime;
    }

    public function setCheckwordTime(?\DateTimeInterface $checkwordTime): self
    {
        $this->checkwordTime = $checkwordTime;

        return $this;
    }

    public function getSecondName(): ?string
    {
        return $this->secondName;
    }

    public function setSecondName(?string $secondName): self
    {
        $this->secondName = $secondName;

        return $this;
    }

    public function getConfirmCode(): ?string
    {
        return $this->confirmCode;
    }

    public function setConfirmCode(?string $confirmCode): self
    {
        $this->confirmCode = $confirmCode;

        return $this;
    }

    public function getLoginAttempts(): ?int
    {
        return $this->loginAttempts;
    }

    public function setLoginAttempts(?int $loginAttempts): self
    {
        $this->loginAttempts = $loginAttempts;

        return $this;
    }

    public function getLastActivityDate(): ?\DateTimeInterface
    {
        return $this->lastActivityDate;
    }

    public function setLastActivityDate(?\DateTimeInterface $lastActivityDate): self
    {
        $this->lastActivityDate = $lastActivityDate;

        return $this;
    }

    public function getAutoTimeZone(): ?string
    {
        return $this->autoTimeZone;
    }

    public function setAutoTimeZone(?string $autoTimeZone): self
    {
        $this->autoTimeZone = $autoTimeZone;

        return $this;
    }

    public function getTimeZone(): ?string
    {
        return $this->timeZone;
    }

    public function setTimeZone(?string $timeZone): self
    {
        $this->timeZone = $timeZone;

        return $this;
    }

    public function getTimeZoneOffset(): ?int
    {
        return $this->timeZoneOffset;
    }

    public function setTimeZoneOffset(?int $timeZoneOffset): self
    {
        $this->timeZoneOffset = $timeZoneOffset;

        return $this;
    }

    public function getTitle(): ?string
    {
        return $this->title;
    }

    public function setTitle(?string $title): self
    {
        $this->title = $title;

        return $this;
    }

    public function getBxUserId(): ?string
    {
        return $this->bxUserId;
    }

    public function setBxUserId(?string $bxUserId): self
    {
        $this->bxUserId = $bxUserId;

        return $this;
    }

    public function getLanguageId(): ?string
    {
        return $this->languageId;
    }

    public function setLanguageId(?string $languageId): self
    {
        $this->languageId = $languageId;

        return $this;
    }

    public function getBlocked(): ?string
    {
        return $this->blocked;
    }

    public function setBlocked(string $blocked): self
    {
        $this->blocked = $blocked;

        return $this;
    }

    /**
     * @return Collection|Group[]
     */
    public function getGroups(): Collection
    {
        return $this->groups;
    }

    public function addGroup(Group $group, ?\DateTimeInterface $from = null, ?\DateTimeInterface $to = null): self
    {
        $criteria = Criteria::create()
            ->where(Criteria::expr()->eq('groupId', $group->getId()));

        if (count($this->groups->matching($criteria)) < 1) {
            $relation = (new User\Group())
                ->setGroup($group)
                ->setUser($this)
                ->setDateActiveFrom($from)
                ->setDateActiveTo($to);

            $this->groups[] = $relation;
        }

        return $this;
    }

    public function removeGroup(Group $group): self
    {
        $criteria = Criteria::create()
            ->where(Criteria::expr()->eq('groupId', $group->getId()));

        /** @var User\Group $relation */
        if ($relation = $this->groups->matching($criteria)->first()) {
            $this->groups->removeElement($relation);
            // set the owning side to null (unless already changed)
            if ($relation->getUser() === $this) {
                $relation->setUser(null);
            }
        }

        return $this;
    }

    public function getPicture(): ?File
    {
        return $this->picture;
    }

    public function setPicture(?File $picture): self
    {
        $this->picture = $picture;

        return $this;
    }

    public function getLogoPicture(): ?File
    {
        return $this->logoPicture;
    }

    public function setLogoPicture(?File $logoPicture): self
    {
        $this->logoPicture = $logoPicture;

        return $this;
    }

}
